<?php

namespace App\Services;

use App\Http\Requests\ContactFormRequest;
use App\Models\ContactForm;

class ContactUsService
{

    public function store(ContactFormRequest $request): ContactForm
    {
        $validatedData = $request->validated();
        return ContactForm::create($validatedData);
    }

}
