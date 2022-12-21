<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Rating extends Model
{

    public const RELATION_NAME = 'ratable';
    /**
     * Get the parent ratable model.
     */
    public function ratable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeTheOnesWith(Builder $query, string $model): Rating|Builder
    {
        return $query->whereHasMorph(self::RELATION_NAME, $model);
    }
}