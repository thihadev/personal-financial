<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletRequest extends FormRequest
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
                'wallet_name' => 'required',
                'initial_amount' => 'required',
                'note' => 'nullable',
            ],
            'PUT', 'PATCH' => [
                'wallet_name' => 'nullable',
                'initial_amount' => 'required',
                'note' => 'nullable',
            ],
            default => [],
        };
    }
}
