<?php

namespace App\Http\Controllers;

use App\Services\PurchaseService;
use App\DTOs\PurchaseDTO;
use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function __construct(protected PurchaseService $service) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAllPurchases());
    }

    public function store(PurchaseRequest $request): JsonResponse
    {
        $dto = PurchaseDTO::fromRequest($request->validated(), Auth::id());
        $purchase = $this->service->createPurchase($dto);

        return response()->json($purchase, 201);
    }

    public function show(Purchase $purchase): JsonResponse
    {
        return response()->json($this->service->getPurchaseById($purchase->id));
    }

    public function cancel(Purchase $purchase): JsonResponse
    {
        try {
            $purchase = $this->service->cancelPurchase($purchase->id, Auth::id());
            return response()->json([
                'message' => 'Compra anulada con éxito y stock revertido',
                'data' => $purchase
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
