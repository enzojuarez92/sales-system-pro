<?php

namespace App\DTOs;

readonly class LoginDTO
{
    public function __construct(
        public string $login,
        public string $password
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            $data['login'],
            (string) $data['password']
        );
    }
}