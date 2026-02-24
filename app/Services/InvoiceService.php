<?php

namespace App\Services;

use App\Contracts\InvoiceRepositoryInterface;
use App\DTOs\InventoryMovementDTO;
use App\DTOs\InvoiceDTO;
use App\DTOs\PaymentDTO; // Importante
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceService
{
    public function __construct(
        protected InvoiceRepositoryInterface $repository,
        protected InventoryMovementService $inventoryService,
        protected PaymentService $paymentService // <--- Inyectamos el servicio de pagos
    ) {}

    public function getAllInvoices()
    {
        return $this->repository->getAll();
    }

    public function createInvoice(InvoiceDTO $dto, ?PaymentDTO $paymentDto = null): Invoice
    {
        return DB::transaction(function () use ($dto, $paymentDto) {
            // 1. Crear cabecera
            $initialStatus = 'pending';
            if ($paymentDto && $paymentDto->amount >= $dto->total_amount) {
                $initialStatus = 'paid';
            }

            // 2. Crear cabecera con el estado dinámico
            $invoice = $this->repository->create([
                'contact_id'   => $dto->contact_id,
                'user_id'      => $dto->user_id,
                'pos_number'   => $dto->pos_number,
                'number'       => $dto->number,
                'type'         => $dto->type,
                'cbte_tipo'    => $dto->cbte_tipo,
                'date'         => $dto->date,
                'total_amount' => $dto->total_amount,
                'status'       => $initialStatus,
                'notes'        => $dto->notes,
            ]);

            // 2. Procesar Ítems y Stock
            foreach ($dto->items as $itemData) {
                // El InventoryMovementService ya tiene tu validación de stock crítico
                $this->inventoryService->registerMovement(new InventoryMovementDTO(
                    product_id: $itemData['product_id'],
                    user_id: $dto->user_id,
                    quantity: -$itemData['quantity'],
                    stock_before: 0,
                    stock_after: 0,
                    movable_id: $invoice->id,
                    movable_type: Invoice::class,
                    concept: "Venta Fac. Nro: {$dto->pos_number}-{$dto->number}"
                ));

                //Aqui agregamos el detalle items
                $invoice->items()->create([
                    'product_id' => $itemData['product_id'],
                    'quantity'   => $itemData['quantity'],
                    'price'      => $itemData['price'],
                    'tax_amount' => $itemData['tax_amount'],
                    'total'      => $itemData['total'],
                ]);
            }

            // 3. Registrar Pago
            if ($paymentDto && $paymentDto->amount > 0) {
                $this->paymentService->registerPayment(
                    invoiceId: $invoice->id,
                    contactId: $dto->contact_id,
                    userId: $dto->user_id,
                    dto: $paymentDto
                );
            }

            return $invoice->load(['items.product', 'payments']);
        });
    }

    public function getInvoiceById(int $id): Invoice
    {
        return $this->repository->findById($id);
    }
}
