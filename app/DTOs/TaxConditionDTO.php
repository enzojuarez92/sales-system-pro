<?php

namespace App\DTOs;

readonly class TaxConditionDTO
{
    public function __construct(
        public string $name
    ){}

    public static function fromRequest(array $data):self
    {
        return new self(
            $data['name']
        );
    }
}
