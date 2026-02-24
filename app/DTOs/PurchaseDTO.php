<?php

namespace App\DTOs;

readonly class PurchaseDTO {
    public function __construct(
        public int $contact_id,
        public int $user_id,
        public string $date,
        public float $total_amount,
        public ?string $number = null,
        public string $status = 'pending',
        public ?string $notes = null,
        public array $items = []
    ) {}

    public static function fromRequest(array $data, int $userId): self {
        return new self(
            contact_id: $data['contact_id'],
            user_id: $userId,
            date: $data['date'],
            total_amount: $data['total_amount'],
            number: $data['number'] ?? null,
            status: $data['status'] ?? 'pending',
            notes: $data['notes'] ?? null,
            items: $data['items'] ?? [] 
        );
    }
}