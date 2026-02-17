<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreatedRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|integer|in:1,0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ];
    }
}
