<?php

namespace App\Services;

use App\DTOs\LoginDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function login(LoginDTO $dto): array
    {
        $user = User::where('email', $dto->login)
            ->orWhere('username', $dto->login)
            ->first();

        if (! $user || ! Hash::check($dto->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

        return [
            'token' => $user->createToken('auth_token')->plainTextToken,
            'user'  => $user->load('roles')
        ];
    }
}
