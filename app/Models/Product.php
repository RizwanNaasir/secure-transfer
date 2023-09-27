<?php

namespace App\Models;

use App\Traits\CanBeRated;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use Searchable, CanBeRated, InteractsWithMedia;

    const IMAGE_COLLECTION = 'products';
    protected $appends = ['full_image'];


    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'media'
    ];

    public function getFullImageAttribute(): string
    {
        $media = $this->getFirstMedia(Product::IMAGE_COLLECTION);
        return filled($media)
            ? $media->getFullUrl()
            : 'https://via.placeholder.com/150';
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('approved', 1);
    }

    public function authUserIsOwner(): bool
    {
        return (int)$this->user_id === (int)auth()->id();
    }

    public function approve(): void
    {
        $this->update(['approved' => !$this->approved]);
        $notification = Notification::make()->title('Product Updated');
        $notification = $this->approved
            ? $notification->success()
            : $notification->danger();
        $notification->send();
    }

    public function contracts(): BelongsToMany
    {
        return $this->belongsToMany(Contract::class);
    }
}

