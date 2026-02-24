<?php

namespace App\Http\Controllers;

use App\DTOs\ContactDTO;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(protected ContactService $service) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAllContacts());
    }

    // Métodos extra útiles para tus combos de Vue
    public function customers(): JsonResponse 
    { 
        return  response()->json($this->service->getCustomers()); 
    }

    public function suppliers(): JsonResponse 
    { 
        return response()->json($this->service->getSuppliers()); 
    }

    public function store(ContactRequest $request): JsonResponse
    {
        $dto = ContactDTO::fromRequest($request->validated());
        return response()->json($this->service->createContact($dto), 201);
    }

    public function show(Contact $contact): JsonResponse
    {
        return response()->json($this->service->getContactById($contact->id));
    }

    public function update(ContactRequest $request, Contact $contact): JsonResponse
    {
        $dto = ContactDTO::fromRequest($request->validated());
        return response()->json($this->service->updateContact($contact->id, $dto));
    }

    public function delete(Contact $contact): JsonResponse
    {
        return response()->json(['success' => $this->service->deleteContact($contact->id)]);
    }
}
