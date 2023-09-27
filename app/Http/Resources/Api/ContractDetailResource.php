<?php

namespace App\Http\Resources\Api;

use App\Models\Contract;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Contract */
class ContractDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        $file = $this->getFirstMedia(Contract::MEDIA_COLLECTION);
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'description' => $this->description,
            'preferred_payment_method' => $this->preferred_payment_method,
            'amount_received_via' => $this->amount_received_via,
            'current_status' => $this->current_status,
            'file_path' => $file?->getFullUrl(),
            'is_pending' => $this->is_pending,
            'created_at' => $this->created_at->format('d-M-Y H-i-s A'),
            'qr_code' => $this->status->qr_code,
            'product' => $this->whenLoaded(
                'products', ProductResource::make($this->products->first())
            )
        ];
    }
}
