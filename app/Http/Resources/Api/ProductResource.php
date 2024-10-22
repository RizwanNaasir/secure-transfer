<?php

namespace App\Http\Resources\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Product */
class ProductResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $media = $this->getFirstMedia(Product::IMAGE_COLLECTION);
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $media?->getFullUrl()
        ];
    }
}
