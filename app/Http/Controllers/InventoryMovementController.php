<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryMovementRequest;
use App\Services\InventoryService;
use App\DTOs\InventoryMovementDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class InventoryMovementController extends Controller
{
    public function __construct(protected InventoryService $service) {}

    public function store(InventoryMovementRequest $request): JsonResponse
    {
        $dto = new InventoryMovementDTO(
            product_id: $request->product_id,
            user_id: Auth::id(), 
            quantity: $request->quantity,
            stock_before: 0, 
            stock_after: 0,  
            movable_id: $request->movable_id,
            movable_type: $request->movable_type,
            concept: $request->concept
        );

        $movement = $this->service->registerMovement($dto);

        return response()->json($movement, 201);
    }
}