<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements HasMedia
{
    use InteractsWithMedia;

    const BANNER_COLLECTION = 'banners';
    public function getImagePathAttribute(): ?string
    {
        return isset($this->image) ? url(Storage::url($this->image)) : null;
    }
}
