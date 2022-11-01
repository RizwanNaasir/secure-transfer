<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
        $contract = $contract->create([
            'amount' => $data['amount'],
            'description' => $data['description'],
            'preferred_payment_method' => $data['preferred_payment_method']
        ]);
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
                url('/contract/process?'
                    . http_build_query([
                            'contract_id' => $contract_id,
                            'recipient_email' => $recipient_email
                        ]
                    )
                )
            );
    }

    public static function acceptContract(Request $request): Model|Builder
    {
        $contract = Contract::query()->where('id', $request->get('contract_id'))
            ->firstOrFail();
        $contract->status()->update(['status' => 'accepted']);
        return $contract;
    }
}
