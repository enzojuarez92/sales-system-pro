<?php

namespace App\DTOs;

readonly class InvoiceDTO
{
    public function __construct(
        public int $contact_id,
        public int $user_id,
        public int $pos_number,
        public int $number,
        public string $type,
        public int $cbte_tipo,
        public string $date,
        public float $total_amount,
        public string $status = 'paid',
        public ?string $notes = null,
        public array $items = []
    ) {}

    public static function fromRequest(array $data, int $userId): self
    {
        return new self(
            contact_id: $data['contact_id'],
            user_id: $userId,
            pos_number: $data['pos_number'],
            number: $data['number'],
            type: $data['type'],
            cbte_tipo: $data['cbte_tipo'],
            date: $data['date'],
            total_amount: $data['total_amount'],
            status: $data['status'] ?? 'paid',
            notes: $data['notes'] ?? null,
            items: $data['items'] ?? []
        );
    }
}
