<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'bank_detail_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bank(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BankDetail::class,'bank_detail_id');
    }
}
