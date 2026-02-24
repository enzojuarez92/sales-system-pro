<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CashSessionService;

class CashSessionController extends Controller
{
    public function __construct(protected CashSessionService $service) {}

    public function open(Request $request)
    {
        $request->validate(['opening_balance' => 'required|numeric|min:0']);
        
        try {
            $session = $this->service->open(Auth::id(), $request->opening_balance);
            return response()->json($session, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function close(Request $request)
    {
        $request->validate(['actual_balance' => 'required|numeric|min:0']);

        try {
            $session = $this->service->close($request->actual_balance);
            return response()->json($session);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function status()
    {
        $session = $this->service->getActiveSession();
        return response()->json($session ?: ['status' => 'closed']);
    }
}
