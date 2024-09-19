<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
                'image' => ['nullable'],
                'category_id' => ['required'],
                'name' => ['required'],
                'type' => ['required'],
            ],
            'PUT', 'PATCH' => [
                'image' => ['nullable'],
                'category_id' => ['required'],
                'name' => ['required'],
                'type' => ['required'],
            ],
            default => [],
        };
    }
}
