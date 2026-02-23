<?php

namespace App\Http\Controllers;

use App\DTOs\TaxConditionDTO;
use App\Http\Requests\TaxConditionRequest;
use App\Models\TaxCondition;
use App\Services\TaxConditionService;
use Illuminate\Http\Request;

class TaxConditionController extends Controller
{
    public function __construct(
        protected TaxConditionService $taxConditionService
    ){}

    public function index()
    {
        $tax_conditions = $this->taxConditionService->getAllTaxConditions();
        return response()->json($tax_conditions, 200);
    }

    public function show(TaxCondition $tax_condition)
    {
        $tax_conditions = $this->taxConditionService->getTaxConditionById($tax_condition->id);
        return response()->json($tax_conditions, 200);
    }

    public function store(TaxConditionRequest $request)
    {
        $dto = TaxConditionDTO::fromRequest($request->validated());
        $tax_condition = $this->taxConditionService->createTaxCondition($dto);
        return response()->json($tax_condition, 201);
    }

    public function update(TaxConditionRequest $request, TaxCondition $tax_condition)
    {
        $dto = TaxConditionDTO::fromRequest($request->validated());
        $tax_condition = $this->taxConditionService->updateTaxCondition($tax_condition->id, $dto);
        return response()->json($tax_condition, 201);
    }

    public function delete(TaxCondition $tax_condition)
    {
        $this->taxConditionService->deleteTaxCondition($tax_condition->id);
        return response()->json(null, 204);
    }
}
