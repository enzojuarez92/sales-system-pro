<?php

namespace App\Repositories;
use App\Contracts\PaymentRepositoryInterface;
use App\Models\Payment;

class EloquentPaymentRepository implements PaymentRepositoryInterface {
    public function create(array $data): Payment {
        return Payment::create($data);
    }
    public function getByInvoice(int $invoiceId) {
        return Payment::where('invoice_id', $invoiceId)->get();
    }
}