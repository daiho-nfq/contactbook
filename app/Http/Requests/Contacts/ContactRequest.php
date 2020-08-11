<?php

namespace App\Http\Requests\Contacts;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:contacts',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:50'
        ];
    }
}
