<?php

namespace App\Services;

use App\Models\CashSession;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CashSessionService
{
    /**
     * Abre una nueva sesión de caja.
     */
    public function open(int $userId, float $amount)
    {
        $exists = CashSession::where('status', 'open')->exists();
        if ($exists) {
            throw new \Exception("Ya existe una sesión de caja abierta.");
        }

        return CashSession::create([
            'user_id'          => $userId,
            'opened_at'        => Carbon::now(),
            'opening_balance'  => $amount,
            'expected_balance' => $amount, 
            'status'           => 'open',
        ]);
    }

    /**
     * Cierra la sesión activa.
     */
    public function close(float $actualBalance, ?string $notes = null)
    {
        return DB::transaction(function () use ($actualBalance) {
            $session = CashSession::where('status', 'open')
                ->lockForUpdate()
                ->first();

            if (!$session) {
                throw new \Exception("No hay ninguna sesión de caja abierta para cerrar.");
            }

            $difference = $actualBalance - $session->expected_balance;

            $session->update([
                'closed_at'      => Carbon::now(),
                'actual_balance' => $actualBalance,
                'difference'     => $difference,
                'status'         => 'closed',
            ]);

            return $session;
        });
    }

    public function getActiveSession()
    {
        return CashSession::where('status', 'open')->first();
    }
}