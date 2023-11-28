<?php

namespace App\Services;

use App\Mail\AcceptContractMail;
use App\Mail\NewContractMail;
use App\Mail\RejectContractMail;
use App\Models\Contract;
use App\Models\ContractStatus;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ContractService extends Service
{
    /**
     * @throws Exception
     */
    public static function create(array $data, User|Authenticatable $user, Product $product = null): string|HtmlString|null
    {
        $recipient = self::getOrCreateAnonymousRecipient(email: $data['email']);

        $contract = self::createContract(Contract::query(), $data, $product);

        self::attachBothUsersToContract($contract, $user, $recipient);

        $qrCode = self::getCode($contract, $recipient);

        self::notifyBothUsersAboutContract($contract, $user, $recipient);

        session()->put('contract_id', $contract->id);

        return $qrCode;
    }

    public static function getOrCreateAnonymousRecipient($email): User
    {
        return User::query()
            ->firstOrCreate([
                'email' => $email
            ], [
                    'name' => substr(
                        string: $email,
                        offset: 0,
                        length: strpos(
                            haystack: $email,
                            needle: '@'
                        )
                    ),
                    'surname' => '',
                ]
            );
    }

    /**
     * @throws Exception
     */
    public static function createContract(Builder $contract, array $data, Product $product = null): Contract
    {
        /** @var Contract $contract */
        $contract = $contract->create([
            'amount' => @$data['amount'],
            'description' => @$data['description'],
            'file' => @$data['file'],
            'preferred_payment_method' => @$data['preferred_payment_method']
        ]);

        if (request()->hasFile('file'))
            try {
                $contract->addMedia(request()->file('file'))
                    ->toMediaCollection(Contract::MEDIA_COLLECTION);
            } catch (FileDoesNotExist|FileIsTooBig $e) {
                throw new Exception($e->getMessage());
            }

        if (!is_null($product)) {
            $product->contracts()->attach($contract->id);
        }
        return $contract;
    }

    public static function attachBothUsersToContract(Model|Builder $contract, User|Authenticatable $user, User $recipient): void
    {
        $contract->user()->attach($user->id, ['recipient_id' => $recipient->id]);
    }

    public static function getCode(Model|Contract $contract, User $recipient): HtmlString|string|null
    {
        $code = self::createQrCode(
            contract_id: $contract->id,
            recipient_email: $recipient->email
        );
        $contract->status()->create([
            'qr_code' => $code
        ]);
        return $code;
    }

    private static function createQrCode(int $contract_id, string $recipient_email): HtmlString|string|null
    {
        return QrCode::size(250)
            ->generate(
                '/api/contract/process?'
                . http_build_query([
                        'contract_id' => $contract_id,
                        'recipient_email' => $recipient_email
                    ]
                )
            );
    }

    public static function notifyBothUsersAboutContract(Model|Contract $contract, User|Authenticatable $user, User $recipient): void
    {
        Mail::to($recipient)
            ->send(new NewContractMail($contract, $user, $recipient));
    }

    public static function notifyUsersAboutRejectContract(Model|Contract $contract, User|Authenticatable $user, User $recipient): void
    {
        Mail::to($user)
            ->send(new RejectContractMail($contract, $user, $recipient));
    }

    public static function notifyUsersAboutAcceptContract(Model|Contract $contract, User|Authenticatable $user, User $recipient): void
    {
        Mail::to($user)
            ->send(new AcceptContractMail($contract, $user, $recipient));
    }

    public static function updateContract(
        Contract|Builder|Model $contract,
        string                 $status = null,
        string                 $buyer_status = null,
        string                 $seller_status = null,
        string                 $description = null
    ): Contract|Model|Builder
    {
        $contract->status()->update([
            'status' => $status,
            'buyer_status' => $buyer_status,
            'seller_status' => $seller_status,
            'description' => $description
        ]);

        $contractStatus = ContractStatus::where('contract_id', $contract->id)->first();
        if ($contractStatus->status === 'declined'){
            self::notifyUsersAboutRejectContract($contract, $contract->user->first(), $contract->recipient->first());
        }

        if ($contractStatus->status === 'accepted'){
            self::notifyUsersAboutAcceptContract($contract, $contract->user->first(), $contract->recipient->first());
        }
        return $contract;
    }

    /**
     * @throws Exception
     */
    public static function deleteContract(Contract $contract): void
    {
        try {
            $contract->products()->detach();
            $contract->status()->delete();
            $contract->user()->detach();
            $contract->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
