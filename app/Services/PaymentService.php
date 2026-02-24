<?php

namespace App\Services;

use App\Contracts\PaymentRepositoryInterface;
use App\DTOs\PaymentDTO;
use App\Models\CashSession;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function __construct(protected PaymentRepositoryInterface $repository) {}

    public function registerPayment(int $invoiceId, int $contactId, int $userId, PaymentDTO $dto)
    {
        return DB::transaction(function () use ($invoiceId, $contactId, $userId, $dto) {
            // Registrar el pago en la DB
            $payment = $this->repository->create([
                'invoice_id'         => $invoiceId,
                'contact_id'         => $contactId,
                'user_id'            => $userId,
                'payment_method_id'  => $dto->payment_method_id,
                'bank_account_id'    => $dto->bank_account_id,
                'amount'             => $dto->amount,
                'reference'          => $dto->reference,
                'date'               => $dto->date ?? now()->toDateString(),
            ]);

            // ACTUALIZAR SALDO DE LA CUENTA
            if ($dto->bank_account_id) {
                $account = \App\Models\BankAccount::lockForUpdate()->find($dto->bank_account_id);
                if ($account) {
                    $account->current_balance += $dto->amount;
                    $account->save();
                }
            }

            $method = PaymentMethod::find($dto->payment_method_id);

            if ($method && $method->type === 'cash') {
                $activeSession = CashSession::where('status', 'open')
                    // ->where('branch_id', $branchId) // Si tuvieras sucursales
                    ->latest()
                    ->first();

                if ($activeSession) {
                    $activeSession->increment('expected_balance', $dto->amount);
                } else {
                    throw new \Exception("No hay una sesión de caja abierta para registrar el pago en efectivo.");
                }
            }

            return $payment;
        });
    }
}
