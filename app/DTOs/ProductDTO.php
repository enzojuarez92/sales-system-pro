<?php

namespace App\DTOs;

readonly class ProductDTO
{
    public function __construct(
        public int $category_id,
        public int $tax_id,
        public string $name,
        public string $slug,
        public string $description,
        public float $cost_price,
        public float $selling_price,
        public int $stock,
        public int $alert_quantity,
        public bool $is_active,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            $data['category_id'],
            $data['tax_id'],
            $data['name'],
            $data['description'] ?? '',
            $data['slug'] ?? '',
            (float) $data['cost_price'],
            (float) $data['selling_price'],
            (int) $data['stock'],
            (int) ($data['alert_quantity'] ?? 0),
            (bool) ($data['is_active'] ?? true),
        );
    }
}
