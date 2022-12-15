<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Http\Resources\ContactFormResource;
use App\Services\ContactUsService;

class ContactUsController extends Controller
{
    public ContactUsService $contactUsService;

    public function __construct(ContactUsService $contactUsService)
    {
        $this->contactUsService = $contactUsService;
    }

    public function store(ContactFormRequest $request): array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    {
        $contactFormData = $this->contactUsService->store($request);

        return (new ContactFormResource($contactFormData))->toArray($request);
//        return response()->json($contactFormData);
    }
}
