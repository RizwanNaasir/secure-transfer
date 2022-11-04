<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ContractService extends Service
{
    public static function create(array $data, User|Authenticatable $user)
    {
        $recipient = self::getOrCreateAnonymousRecipient(email: $data['email']);

        $contract = self::createContract(Contract::query(), $data);

        self::attachBothUsersToContract($contract, $user, $recipient);

        session()->put('contract_id', $contract->id);

        return self::getCode($contract, $recipient);
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

    public static function createContract(Builder $contract, array $data): Builder|Model
    {
        return $contract->create([
            'amount' => $data['amount'],
            'description' => $data['description'],
            'file' => $data['file'],
            'preferred_payment_method' => $data['preferred_payment_method']
        ]);
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
                url('/contract/process?'
                    . http_build_query([
                            'contract_id' => $contract_id,
                            'recipient_email' => $recipient_email
                        ]
                    )
                )
            );
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
}
