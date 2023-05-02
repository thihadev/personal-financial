<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
        return [
            'amount'        => ['required'],
            'fees'          => ['nullable'],
            'description'   => ['nullable'],
            'date'          => ['required'],
            'category_id'   => ['required'],
            'wallet_id'     => ['required'],
            'transfer_wallet_id'     => ['nullable'],
        ];
    }
}
