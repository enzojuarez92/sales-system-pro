<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'tax_id',
        'name',
        'slug',
        'description',
        'cost_price',
        'selling_price',
        'stock',
        'alert_quantity',
        'is_active',
        'image_path'
    ];

    protected $appends = ['image_url'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tax(): BelongsTo
    {
        return $this->belongsTo(Tax::class);
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(
            fn() =>
            $this->image_path
                ? asset('storage/' . $this->image_path)
                : asset('images/default-product.png')
        );
    }
}
