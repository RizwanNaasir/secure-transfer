<?php

namespace App\Models;

use App\Traits\CanBeRated;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Contract extends Model implements HasMedia
{
    use HasFactory, CanBeRated, InteractsWithMedia;

    const MEDIA_COLLECTION = 'contracts';
    protected $appends = [
        'current_status',
        'sender_detail',
        'recipient_detail',
    ];

    public function getFilePathAttribute(): ?string
    {
        return isset($this->file) ? url(Storage::url($this->file)) : null;
    }

    public function getFileNameAttribute(): string
    {
        return basename($this->file);
    }

    public function getIsPendingAttribute(): bool
    {
        return $this->status()->where(['status' => 'pending'])->exists();
    }

    public function getIsAcceptedAttribute(): bool
    {
        return $this->status()->where(['status' => 'accepted'])->exists();
    }

    public function getIsDeliveredAttribute(): bool
    {
        return $this->status()->where(['seller_status' => 'delivered'])->exists();
    }

    public function getIsCompleteAttribute(): bool
    {
        return $this->status()->where(['buyer_status' => 'complete'])->exists();
    }

    public function status(): HasOne
    {
        return $this->hasOne(ContractStatus::class);
    }
    public function description(): HasOne
    {
        return $this->hasOne(ContractStatus::class);
    }
    public function scopeNotPending(Builder $query): Builder
    {
        return $query->whereHas('status',function (Builder $query){
            return $query->whereNot(['status' => 'pending']);
        });
    }
    public function scopePending(Builder $query): Builder
    {
        return $query->whereHas('status',function (Builder $query){
            return $query->where(['status' => 'pending']);
        });
    }

    public function getCurrentStatusAttribute(): string
    {
        return match ($this->status?->status) {
            'accepted' => __('lang.accepted'),
            'declined' => __('lang.declined'),
            default => __('lang.pending'),
        };
    }

    public function getSenderDetailAttribute(): array
    {
        $data = $this->user()->first();
        return [
            'name' => $data?->full_name,
            'email' => $data?->email,
        ];
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function getRecipientDetailAttribute(): array
    {
        $data = $this->recipient()->first();
        return
            [
                'name' => $data?->full_name,
                'email' => $data?->email,
            ];
    }

    public function recipient(): BelongsToMany
    {
        return $this->belongsToMany(related: User::class, relatedPivotKey: 'recipient_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
