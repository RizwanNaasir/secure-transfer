<?php

namespace App\Models;

use App\Traits\CanBeRated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable, CanBeRated;

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
    ];

    public function getFullImageAttribute(): string
    {
        return filled($this->image) && file_exists(Storage::path($this->image))
            ? url(Storage::url($this->image))
            : 'https://via.placeholder.com/150';
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function authUserIsOwner(): bool
    {
        return (int) $this->user_id === (int) auth()->id();
    }

}

