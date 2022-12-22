<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{

    public function getImagePathAttribute(): ?string
    {
        return isset($this->image) ? url(Storage::url($this->image)) : null;
    }
}