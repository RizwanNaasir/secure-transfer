<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContractRequest;
use App\Http\Resources\Api\ContractDetailResource;
use App\Http\Resources\Api\ContractListResource;
use App\Models\Contract;
use App\Models\ContractStatus;
use App\Models\Product;
use App\Models\User;
use App\Services\ContractService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ContractController extends Controller
{
    public function store(ContractRequest $request)
    {
        $contract_sender = auth()->user();
        $product = Product::findOrFail($request->input('product_id'));
        if ($contract_sender->email == $request->input('email')) {
            return $this->error(message: 'You cannot make a contract with yourself');
        }
        if ($product->user_id == $contract_sender->id) {
            return $this->error(message: 'You cannot make a contract with your own product');
        }
        if ($request->input('preferred_payment_method') == 'wallet') {
            $contract_sender->withdraw($request->input('amount'));
        }

        $QRCode = ContractService::create(
            data: $this->formattedData($request),
            user: $request->user(),
            product: $product
        );
        try {
            return $this->success(
                data: [
                    'qr_code' => $QRCode->toHtml()
                ],
                message: 'Contract added successfully'
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    public function formattedData(Request $request): array
    {
        return [
            'email' => $request->input('email'),
            'amount' => $request->input('amount'),
            'description' => $request->input('description'),
            'file' => $request->input('file'),
            'preferred_payment_method' => $request->input('preferred_payment_method'),
        ];
    }

    public function contractList(Request $request)
    {
        $list_received = $request->user()
            ->receivedContracts()
            ->get()
            ->load('status')
            ->sortByDesc('id');

        $list_send = $request->user()
            ->contracts()
            ->get()
            ->load('status')
            ->sortByDesc('id');

        return $this->success(data: [
            'received' => ContractListResource::collection($list_received),
            'sent' => ContractListResource::collection($list_send),
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function contractDetails(Contract $contract)
    {
        (bool)$fromSender = request()->get('from-sender', false);
        $user = $fromSender ? $contract->user->first() : $contract->recipient->first();
        $contract->load('products','products.ratings');
        $user->loadCount('products', 'ratings');
        return $this->success(data: [
            'contract' => ContractDetailResource::make($contract),
            'user' => [
                'id' => $user->id,
                'name' => $user->full_name,
                'email' => $user->email,
                'average_rating' => $user->average_rating,
                'total_reviews' => $user->ratings_count
            ],
        ]);
    }

    public function acceptContract(Request $request)
    {
        $contract = Contract::findOrFail($request->input('contract_id'));
        /*$contract_sender = $contract->user()->first();*/
        $contract_receiver = $contract->recipient()->first();
        if($contract_receiver->id !== $request->user()->id){
            return $this->error(message: 'This contract does not belong to you');
        }
        if ($contract->current_status !== 'Pending'){
            return $this->success(message: 'This Contract cannot be accepted');
        } else {
            ContractService::updateContract($contract, 'accepted');
            /*if ($contract->preferred_payment_method == 'wallet') {
                $contract_receiver->deposit($contract->amount);
            }*/
            return $this->success(message: 'Contract accepted');
        }
    }

    public function deliveredContract(Request $request)
    {
        $contractStatus = '';
        $contractIsReceived = DB::table('contract_user')
            ->where('contract_id', $request->input('contract_id'))
            ->where('recipient_id', $request->user()->id)
            ->exists();
        $contract = ContractStatus::query()
            ->where('contract_id', $request->input('contract_id'))
            ->where('status', 'accepted')
            ->first();
        if ($contractIsReceived && $contract?->seller_status !== 'delivered' )
        {

            if ($request->hasFile('file')) {
                try {
                    $contract->addMedia($request->file('file'))
                        ->toMediaCollection(ContractStatus::MEDIA_COLLECTION_SELLER);
                } catch (FileDoesNotExist|FileIsTooBig $e) {
                    return $this->error($e->getMessage(), 422);
                }
            }
            $contractStatus = ContractService::updateContract(
                $contract->contract()->first(),
                $contract->status,
                $contract->buyer_status,
                'delivered'
            );

        }

        if(filled($contractStatus))
        {
            $buyer = $contractStatus?->status?->buyer_status;
            $seller = $contractStatus?->status?->seller_status;
            $qrCode = $contractStatus?->status?->qr_code;
        }
        else{
            $seller =  $contract?->seller_status;
            $buyer = $contract?->buyer_status;
            $qrCode = $contract?->qr_code;
        }

        /*        $seller = $contractStatus?->status?->seller_status ?? $contract?->seller_status;
                $buyer = $contractStatus?->status?->buyer_status ?? $contract?->buyer_status;*/

        $sellerFile =  $contract?->getFirstMedia(ContractStatus::MEDIA_COLLECTION_SELLER);
        return $this->success(

            data: [
                'qr_code' => $qrCode,
                'file' => $sellerFile?->getFullUrl(),
                'buyer_status' => $buyer,
                'seller_status' => $seller
            ],
            message: 'Contract delivered successfully'
        );
    }

    public function completeContract(Request $request)
    {
        $contractStatus = '';
        $contractIsSender = DB::table('contract_user')
            ->where('contract_id', $request->input('contract_id'))
            ->where('user_id', $request->user()->id)
            ->exists();
        /*$contractSeler = Contract::where('id', $request->input('contract_id'))->with('status')->exists();*/
        $contract = ContractStatus::query()
            ->where('contract_id', $request->input('contract_id'))
            ->where('status', 'accepted')
            ->first();
        if ($contractIsSender && $contract?->buyer_status !== 'complete' )
        {
            if ($request->hasFile('file')) {
                try {
                    $contract->addMedia($request->file('file'))
                        ->toMediaCollection(ContractStatus::MEDIA_COLLECTION_BUYER);
                } catch (FileDoesNotExist|FileIsTooBig $e) {
                    return $this->error($e->getMessage(), 422);
                }
            }
            ContractService::updateContract(
                $contract->contract()->first(),
                $contract->status,
                'complete',
                $contract->seller_status,
            );
        }

        /*$buyerFile =  $contract?->getFirstMedia(ContractStatus::MEDIA_COLLECTION_BUYER);*/

       /* if(filled($contractStatus))
        {
            $buyer = $contractStatus?->status?->buyer_status;
            $seller = $contractStatus?->status?->seller_status;
            $qrCode = $contractStatus?->status?->qr_code;
        }
        else{
            $seller =  $contract?->seller_status;
            $buyer = $contract?->buyer_status;
            $qrCode = $contract?->qr_code;
        }*/

        /*        $seller = $contractStatus?->status?->seller_status ?? $contract?->seller_status;
                $buyer = $contractStatus?->status?->buyer_status ?? $contract?->buyer_status;*/

        /*$sellerFile =  $contract?->getFirstMedia(ContractStatus::MEDIA_COLLECTION_SELLER);*/

        return $this->success(

           /* data: [
                'qr_code' => $contract->qr_code,
                'file' => $buyerFile?->getFullUrl()
            ],*/
            message: 'Contract complete successfully'
        );
    }

    public function declineContract(Request $request)
    {
        $contract = Contract::findOrFail($request->input('contract_id'));
        /*$contract_receiver = $contract->recipient()->first();*/
        $contract_sender = $contract->user()->first();
        if ($contract->current_status !== 'Pending'){
            return $this->success(message: 'This Contract cannot be declined');
        } else {
            ContractService::updateContract($contract, 'declined', \request()->input('description'));
            if ($contract->preferred_payment_method == 'wallet') {
                $contract_sender->deposit($contract->amount);
            }
            return $this->success(message: 'Contract declined');
        }
    }

    public function process(Request $request)
    {
        $contract = Contract::query()->where('id', $request->get('contract_id'))
            ->firstOrFail();
        if (!$contract->is_pending) {
            return $this->error(message: 'Contract Already Resolved');
        }

        if ($contract->recipient_detail['email'] !== $request->user()->email) {
            return $this->error(message: 'This contract does not belong to you');
        }

        $tempUser = $this->getUserVia(email: $request->get('recipient_email'));

        if (filled($tempUser)) {
            return $this->error(message: 'You need to register before you can perform any actions.');
        }

        $response = ContractService::updateContract($contract, 'accepted');

        if (filled($response)) {
            return $this->success(message: 'Contract Accepted Successfully');
        } else {
            return $this->error(message: 'Something Went Wrong!');
        }

    }

    public function getUserVia(string $email): object|null
    {
        return User::query()
            ->where(['email' => $email])
            ->whereNull('password')
            ->first();
    }
}
