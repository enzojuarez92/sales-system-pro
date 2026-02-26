<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tax_condition_id',
        'first_name',
        'last_name',
        'identification_number',
        'email',
        'phone',
        'address',
        'city',
        'is_customer',
        'is_supplier',
        'is_active'
    ];

    protected $appends = ['full_name'];

    // Relación con Condición Fiscal
    public function taxCondition(): BelongsTo
    {
        return $this->belongsTo(TaxCondition::class);
    }

    // Accessor para ver "Juan Perez" o solo "Empresa S.A."
    protected function fullName(): Attribute
    {
        return Attribute::get(
            fn() =>
            trim("{$this->first_name} {$this->last_name}")
        );
    }

    public function getBalanceAttribute()
    {
        $totalInvoiced = $this->invoices()->sum('total_amount');
        $totalPaid = $this->payments()->sum('amount');

        return $totalInvoiced - $totalPaid;
    }
}
