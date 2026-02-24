<?php 

namespace App\DTOs;

readonly class ContactDTO
{
    public function __construct(
        public int $tax_condition_id,
        public string $first_name,
        public ?string $last_name,
        public ?string $identification_number,
        public ?string $email,
        public ?string $phone,
        public ?string $address,
        public ?string $city,
        public bool $is_customer,
        public bool $is_supplier,
        public bool $is_active = true
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            tax_condition_id: $data['tax_condition_id'],
            first_name: $data['first_name'],
            last_name: $data['last_name'] ?? null,
            identification_number: $data['identification_number'] ?? null,
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            address: $data['address'] ?? null,
            city: $data['city'] ?? null,
            is_customer: (bool)($data['is_customer'] ?? true),
            is_supplier: (bool)($data['is_supplier'] ?? false),
            is_active: (bool)($data['is_active'] ?? true),
        );
    }
}