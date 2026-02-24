<?php

namespace App\Services;

use App\Contracts\PaymentRepositoryInterface;
use App\DTOs\PaymentDTO;

class PaymentService
{
    public function __construct(protected PaymentRepositoryInterface $repository) {}

    public function registerPayment(int $invoiceId, int $contactId, int $userId, PaymentDTO $dto)
    {
        return $this->repository->create([
            'invoice_id'         => $invoiceId,
            'contact_id'         => $contactId,
            'user_id'            => $userId,
            'payment_method_id'  => $dto->payment_method_id,
            'bank_account_id'    => $dto->bank_account_id,
            'amount'             => $dto->amount,
            'reference'          => $dto->reference,
            'date'               => $dto->date ?? now()->toDateString(),
        ]);
    }
}
