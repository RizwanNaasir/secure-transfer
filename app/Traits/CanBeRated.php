<?php

namespace App\Traits;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait CanBeRated
{
    public function ratings(): MorphMany
    {
        return $this->morphMany(Rating::class, Rating::RELATION_NAME);
    }

    public function review(
        Model                $modelTobeReviewed,
        User|Authenticatable $reviewer,
        int                  $stars,
        string               $review = null)
    {
        $ratingOnThisModel = Rating::query()
            ->where('reviewer_id', $reviewer->id)
            ->whereRatableType($modelTobeReviewed::class)
            ->whereRatableId($modelTobeReviewed->id);

        if ($ratingOnThisModel->exists()) {

            $ratingOnThisModel->update([
                'stars' => $stars
            ]);
            return $ratingOnThisModel->first()?->stars;
        } else {
            (new Rating())
                ->ratable()
                ->associate($modelTobeReviewed)
                ->setAttribute('stars', $stars)
                ->setAttribute('reviewer_id', $reviewer->id)
                ->setAttribute('review', $review)
                ->save();
            return true;
        }
    }

    public function getAverageRatingAttribute(): float|int
    {
        return $this->ratings->average('stars') ?? 0;
    }
    public function getReviewsCountAttribute(): int
    {
        return $this->ratings->count();
    }
}