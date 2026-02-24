<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'invoice_id',
        'contact_id',
        'bank_account_id',
        'user_id',
        'payment_method_id',
        'amount',
        'date',
        'reference'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
