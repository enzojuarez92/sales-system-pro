<?php

namespace App\DTOs;

readonly class TaxDTO
{
    public function __construct(
        public string $name,
        public float $percentage
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            $name = $data['name'],
            $percentage = (float) $data['percentage']
        );
    }
}