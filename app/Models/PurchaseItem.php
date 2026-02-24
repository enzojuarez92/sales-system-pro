<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseItem extends Model
{
    protected $fillable = [
        'purchase_id', 'product_id', 'quantity', 'cost_price', 'tax_amount', 'subtotal'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
