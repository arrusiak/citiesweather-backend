<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//    public function authorize(): bool
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['email' => "string", 'comments' => "string", 'subject' => "string"])] public function rules(): array
    {
        return [
            'email' => 'required|email',
            'comments' => 'required|string|min:10',
            'subject' => 'required|string|min:5|max:45',
        ];
    }
}
