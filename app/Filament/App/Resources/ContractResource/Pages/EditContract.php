<?php

namespace App\Filament\App\Resources\ContractResource\Pages;

use App\Filament\App\Resources\ContractResource;
use App\Models\Contract;
use App\Models\ContractStatus;
use App\Models\Product;
use App\Models\Rating;
use App\Services\ContractService;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use IbrahimBougaoua\FilamentRatingStar\Actions\RatingStar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;

/**
 * @property Contract $record
 */
class EditContract extends EditRecord
{
    protected static string $resource = ContractResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];
        $contractIsReceived = DB::table('contract_user')
            ->where('contract_id', $this?->record?->id)
            ->where('recipient_id', auth()->id())
            ->exists();

        $contractIsSender = DB::table('contract_user')
            ->where('contract_id', $this?->record?->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($contractIsReceived && $this?->record?->is_pending) {
            $actions = [
                Actions\Action::make('accept_contract')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalDescription('Accept contract')
                    ->action(function () {
                        ContractService::updateContract(contract: $this->record, status: 'accepted');
                    }),

                /*->action(function () {
                    $product_owner  = $this->record->recipient->first();
                    $amount = $this->record->amount;
                    ContractService::updateContract(contract: $this->record, status: 'accepted');
                    if ($this->record->preferred_payment_method === 'wallet')
                    {
                        $product_owner->deposit($amount);
                    }

                }),*/

                Actions\Action::make('cancel_contract')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalDescription('Are you sure you want to cancel this contract?')
                    ->form([
                        TextInput::make('description')->live()
                    ])
                    ->action(function (array $data) {
                        ContractService::updateContract(
                            contract: $this?->record,
                            status: 'declined',
                            description: $data['description']
                        );
                    })


//                    ->action(function () {
//                        $contract_send_owner  = $this->record->user->first();
//                        $amount = $this->record->amount;
//                        ContractService::updateContract(
//                            contract: $this->record,
//                            status: 'declined'
//                        );
////                        if ($this->record->preferred_payment_method === 'wallet')
////                        {
////
////                            /*$contract_send_owner->deposit($amount, meta: ['description' => 'Contract cancelled']);*/
////                        }
//                    })
            ];
        }
        if ($contractIsReceived && $this?->record?->is_accepted) {
            $actions = [
                Actions\Action::make('Delivered')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalDescription('Please Scan the Qr code')
                    ->form([
                        Tabs::make('QrCode/File')
                            ->tabs([
                                Tabs\Tab::make('QrCode')
                                    ->schema([
                                        Placeholder::make('')->content(function () {
                                            $qrCode = $this?->record?->status?->qr_code;
                                            return new HtmlString(
                                                '<span class="flex text-center justify-center items-center">
                                                    ' . $qrCode . '
                                                    </span>'
                                            );
                                        })
                                    ]),
                                Tabs\Tab::make('File')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('file')
                                            ->required()
                                            ->collection(ContractStatus::MEDIA_COLLECTION_SELLER),
                                    ]),
                            ]),

                    ])
                    ->action(function () {
                        ContractService::updateContract(
                            contract: $this?->record,
                            status: $this?->record?->status?->status,
                            buyer_status: $this?->record?->status?->buyer_status,
                            seller_status: 'delivered'


                        );
                    })
            ];
        }

        if ($contractIsReceived && $this?->record?->is_accepted && $this?->record?->is_delivered) {
            $productId = $this?->record?->products?->first();
            $receivedContract = Rating::query()
                ->whereReviewerId(auth()->id())
                ->theOnesWith(Product::class)
                ->whereRatableId($productId?->id)
                ->exists();
            $actions = [
                Actions\Action::make('Release payment')
                    ->color('success')
                    ->action(function () {
                        if ($this->record->status->buyer_status !== 'complete') {
                            Notification::make()->title('Alert')
                                ->warning()
                                ->body('Product not received yet by buyer')
                                ->send();
                        } else {
                            Notification::make()->title('Release payment')
                                ->success()
                                ->body('Request send to admin')
                                ->send();
                        }
                    }),

                Actions\Action::make('Rating')
                    ->hidden(function () use ($receivedContract) {
                        return $receivedContract;
                    })
                    ->color('warning')
                    ->icon('heroicon-o-star')
                    ->requiresConfirmation()
                    ->modalHeading('Give the rating of product')
                    ->modalDescription('')
                    ->modalContent()
                    ->modalIcon('')
                    ->form([
                        Section::make()->schema([
                            RatingStar::make('rating')
                                ->live()
                                ->label(''),
                            Checkbox::make('enable')
                                ->live()
                                ->label('Add Description')
                                ->inline(),
                            TextInput::make('description')
                                ->live()
                                ->visible(function (Get $get) {
                                    return $get('enable');
                                })
                        ])
                    ])->action(function (array $data) {
                        $rating = (int)$data['rating'];
                        $description = @$data['description'];
                        $user = \Auth::user();
                        $product = $this?->record?->products?->first();
                        $user->review(
                            $product,
                            $user,
                            $rating,
                            $description
                        );
                    }),
            ];
        }


        if ($contractIsSender && !$this?->record?->is_complete) {

            $actions = [
                Actions\Action::make('Contract complete')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalDescription('Please Scan the Qr code')
                    ->form([
                        Tabs::make('QrCode/File')
                            ->tabs([
                                Tabs\Tab::make('QrCode')
                                    ->schema([
                                        Placeholder::make('')->content(function () {
                                            $qrCode = $this?->record?->status?->qr_code;
                                            return new HtmlString(
                                                '<span class="flex text-center justify-center items-center">
                                                    ' . $qrCode . '
                                                    </span>'
                                            );
                                        })
                                    ]),
                                Tabs\Tab::make('File')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('file')
                                            ->required()
                                            ->collection(ContractStatus::MEDIA_COLLECTION_BUYER),
                                    ]),
                            ]),

                    ])
                    ->action(function () {
                        ContractService::updateContract(
                            contract: $this?->record,
                            status: $this?->record?->status?->status,
                            buyer_status: 'complete',
                            seller_status: $this?->record?->status?->seller_status
                        );
                    }),
            ];
        }
        if ($contractIsSender && $this?->record?->is_complete)
        {
            $productId = $this?->record?->products?->first();
            $senderContract = Rating::query()
                ->whereReviewerId(auth()->id())
                ->theOnesWith(Product::class)
                ->whereRatableId($productId?->id)
                ->exists();
            $actions = [
                Actions\Action::make('Rating')
                    ->hidden(function () use ($senderContract) {
                        return $senderContract;
                    })
                    ->color('warning')
                    ->icon('heroicon-o-star')
                    ->requiresConfirmation()
                    ->modalHeading('Give the rating of product')
                    ->modalDescription('')
                    ->modalContent()
                    ->modalIcon('')
                    ->form([
                        Section::make()->schema([
                            RatingStar::make('rating')
                                ->live()
                                ->label(''),
                            Checkbox::make('enable')
                                ->live()
                                ->label('Add Description')
                                ->inline(),
                            TextInput::make('description')
                                ->live()
                                ->visible(function (Get $get) {
                                    return $get('enable');
                                })
                        ])
                    ])->action(function (array $data) {
                        $rating = (int)$data['rating'];
                        $description = @$data['description'];
                        $user = \Auth::user();
                        $product = $this?->record?->products?->first();
                        $user->review(
                            $product,
                            $user,
                            $rating,
                            $description
                        );
                    }),
            ];
        }
        else {
            Actions\DeleteAction::make();
        }
        return $actions;
    }

    protected function afterFill(): void
    {
        $this->form->fill([
            'email' => $this->record->recipient->first()->email ?? '',
            ...$this->form->model->getAttributes()
        ]);
    }

}
