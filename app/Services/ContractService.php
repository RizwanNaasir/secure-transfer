<?php

namespace App\Services;

use App\Mail\NewContractMail;
use App\Models\Contract;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ContractService extends Service
{
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

    public static function createContract(Builder $contract, array $data, Product $product = null): Contract
    {
        $contract = $contract->create([
            'amount' => @$data['amount'],
            'description' => @$data['description'],
            'file' => @$data['file'],
            'preferred_payment_method' => @$data['preferred_payment_method']
        ]);
        if (!is_null($product)) {
            $product->contracts()->attach($contract->id);
        }
        return $contract;
    }

    public static function attachBothUsersToContract(Model|Builder $contract, User|Authenticatable $user, User $recipient): void
    {
        $contract->user()->attach($user->id, ['recipient_id' => $recipient->id]);
    }

    public static function getCode(Model|Builder $contract, User $recipient)
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

    private static function createQrCode(int $contract_id, string $recipient_email)
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

    public static function notifyBothUsersAboutContract(Model|Builder $contract, User|Authenticatable $user, User $recipient): void
    {
        Mail::to($recipient)
            ->send(new NewContractMail($contract, $user, $recipient));
    }

    public static function updateContract(
        Contract|Builder|Model $contract,
        string                 $status,
        string                 $description = null
    ): Contract|Model|Builder
    {
        $contract->status()->update([
            'status' => $status,
            'description' => $description
        ]);
        return $contract;
    }

    /**
     * @throws Exception
     */
    public static function deleteContract(Contract|Model $contract): void
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
