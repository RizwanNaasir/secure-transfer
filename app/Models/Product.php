<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Product extends Model
{
    use HasFactory;
    protected $appends = ['full_image'];


    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'image',
        ];

    protected $hidden=[
        'created_at',
        'updated_at',
    ];

    public function getFullImageAttribute()
    {
        return asset('/' . $this->image);
    }
    public function user() : belongsTo
    {
        return $this->belongsTo(User::class);
    }



}

