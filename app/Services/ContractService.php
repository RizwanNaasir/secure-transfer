<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class ContractService extends Service
{
    public static function create(array $data, User|Authenticatable $user)
    {
        $recipient = self::getOrCreateAnonymousRecipient(email: $data['email']);

        $contract = Contract::query();
        $contract = $contract->create([
            'amount' => $data['amount'],
            'description' => $data['description'],
            'preferred_payment_method' => $data['preferred_payment_method']
        ]);
        $contract->user()->attach($user->id,['recipient_id'=> $recipient->id ]);
        $contract->status()->create(['qr_code' => fake()->url]);
        return $contract;
    }

    /**
     * @param $email
     * @return User
     */
    public static function getOrCreateAnonymousRecipient($email): User
    {
        return User::query()
            ->firstOrCreate([
                'email' => $email
            ], [
                    'name' => fake()->name,
                    'surname' => fake()->name,
                ]
            );
    }
}
