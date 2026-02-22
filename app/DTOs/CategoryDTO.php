<?php

namespace App\DTOs;

readonly class CategoryDTO
{
    public function __construct(
        public string $name,
        public string $description,
        public ?int $parent_id = null
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            $name = $data['name'],
            $description = (string) $data['description'],
            isset($data['parent_id']) ? (int) $data['parent_id'] : null
        );
    }
}
