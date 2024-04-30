<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaybackRequest extends FormRequest
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
                'wallet_id' => ['required'],
                'transaction_id' => ['required'],
                'type' => ['required'],
                'amount' => ['required'],
                'date' => ['required'],
                'description' => ['nullable'],
                'user' => ['nullable'],
            ],
            'PUT', 'PATCH' => [
                'wallet_id' => ['required'],
                'transaction_id' => ['required'],
                'type' => ['required'],
                'amount' => ['required'],
                'date' => ['required'],
                'description' => ['nullable'],
                'user' => ['nullable'],
            ],
            default => [],
        };
    }
}
