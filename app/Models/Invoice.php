<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $fillable = [
        'contact_id',
        'user_id',
        'pos_number',
        'number',
        'type',
        'cbte_tipo',
        'date',
        'total_amount',
        'status',
        'cae',
        'cae_expiration',
        'notes'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    // app/Models/Invoice.php

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
