<?php

namespace App\DTOs;

readonly class CategoryDTO
{
    public function __construct(
        public string $name,
        public string $description
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            $name = $data['name'],
            $description = (string) $data['description']
        );
    }
}
