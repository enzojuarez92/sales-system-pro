<?php

namespace App\Http\Middleware;

use App\Models\CashSession;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOpenCashSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $activeSession = CashSession::where('status', 'open')->first();

        if (!$activeSession) {
            return response()->json(['error' => 'Debe abrir caja.'], 403);
        }

        if ($activeSession->opened_at->format('Y-m-d') !== now()->format('Y-m-d')) {
            return response()->json([
                'error' => 'Tiene una caja abierta de un día anterior. Debe cerrarla antes de continuar.'
            ], 403);
        }

        return $next($request);
    }
}
