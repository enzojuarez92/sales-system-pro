<?php

namespace App\Http\Controllers;

use App\DTOs\LoginDTO;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function login(LoginRequest $request)
    {
        $dto = LoginDTO::fromRequest($request->validated());
        $result = $this->authService->login($dto);

        return response()->json($result);
    }
}
