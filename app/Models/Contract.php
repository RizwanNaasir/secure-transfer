<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Contract extends Model
{
    use HasFactory;


    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function recipient(): BelongsToMany
    {
        return $this->belongsToMany(related: User::class,relatedPivotKey: 'recipient_id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(ContractStatus::class);
    }

    public function getFileAttribute($file): ?string
    {
        return isset($file) ? Storage::url($file) : null;
    }

    public function getFileNameAttribute(): string
    {
        return basename($this->file);
    }

    public function getIsAcceptedAttribute(): bool
    {
        return $this->status()->where(['status' => 'accepted'])->exists();
    }
}
