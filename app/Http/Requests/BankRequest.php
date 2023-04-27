<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return match ($this->method()) {
            'POST' => [
                'name' => 'required|unique:banks',
                'logo' => 'required',
            ],
            'PUT', 'PATCH' => [
                'name' => 'required|unique:banks, name, '.$this->route('banks'),
                'logo' => 'required',
            ],
            default => [],
        };
    }
}
