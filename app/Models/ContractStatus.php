<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ContractStatus extends Model implements HasMedia
{
    use InteractsWithMedia;

    const MEDIA_COLLECTION_SELLER = 'seller_file';
    const MEDIA_COLLECTION_BUYER = 'buyer_file';

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }


}
