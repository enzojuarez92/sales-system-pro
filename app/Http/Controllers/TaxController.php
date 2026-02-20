<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaxService;
use App\DTOs\TaxDTO;
use App\Http\Requests\StoreTaxRequest;
use App\Models\Tax;

class TaxController extends Controller
{
    public function __construct(
        protected TaxService $taxService
    ) {}

    public function index()
    {
        $taxes = $this->taxService->getAllTaxes();
        return response()->json($taxes);
    }

    public function show(Tax $tax)
    {
        $tax = $this->taxService->getTaxById($tax->id);
        return response()->json($tax);
    }

    public function store(StoreTaxRequest $request)
    {
        $dto = TaxDTO::fromRequest($request->validated());
        $tax = $this->taxService->createTax($dto);

        return response()->json($tax, 201);
    }
}
