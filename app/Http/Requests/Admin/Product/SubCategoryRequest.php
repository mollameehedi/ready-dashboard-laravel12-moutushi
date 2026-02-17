<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $rules = [
            'name' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',
            'category_id' => 'required|exists:categories,id',
        ];

        if ($this->method() === 'PUT') {
            $rules['name'] = [
                'required',
                'string',
                'max:255',
                 Rule::unique('sub_categories')->ignore($this->route('sub')), // Use route parameter
            ];
        } else {
            $rules['name'] = [
                'required',
                'string',
                'max:255',
                'unique:sub_categories'
            ];
        }

        return $rules;
    }
}
