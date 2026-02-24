<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class InventoryMovement extends Model
{
    protected $fillable = [
        'product_id', 'user_id', 'quantity', 
        'stock_before', 'stock_after', 
        'movable_id', 'movable_type', 'concept'
    ];

    // LA CLAVE: Relación polimórfica ✅
    public function movable(): MorphTo
    {
        return $this->morphTo();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
