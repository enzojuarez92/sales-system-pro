<?php

namespace App\Http\Controllers;

use App\DTOs\InvoiceDTO;
use App\DTOs\PaymentDTO;
use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function __construct(
        protected InvoiceService $service
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAllInvoices());
    }

    public function store(InvoiceRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $userId = Auth::id();

        $invoiceDto = InvoiceDTO::fromRequest($validated, $userId);

        $paymentDto = null;
        if ($request->filled('payment_method_id')) {
            $paymentDto = new PaymentDTO(
                amount: $validated['amount_paid'] ?? $validated['total_amount'],
                payment_method_id: $validated['payment_method_id'],
                bank_account_id: $validated['bank_account_id'] ?? null,
                reference: $validated['payment_reference'] ?? null,
                date: $validated['date']
            );
        }

        try {
            $invoice = $this->service->createInvoice($invoiceDto, $paymentDto);
            return response()->json($invoice, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getInvoiceById($id));
    }
}
