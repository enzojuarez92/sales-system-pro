<?php

namespace App\DTOs;

readonly class PaymentDTO {
    public function __construct(
        public float $amount,
        public int $payment_method_id,
        public ?int $bank_account_id = null,
        public ?string $reference = null,
        public ?string $date = null
    ) {}
}