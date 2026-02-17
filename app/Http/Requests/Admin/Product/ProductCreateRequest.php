<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductCreateRequest extends FormRequest
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
            'title' => 'required|unique:products',
            'product_code' => 'required|unique:products',
            'short_description' => 'required',
            'long_description' => 'nullable|max:2000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'multiple_image' => 'required|array',
            'multiple_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'pre_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'alert_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'model' => 'nullable|string',
            'models' => 'nullable|array',
            'models.*' => 'nullable|string',
            'colors' => 'nullable|array',
            'colors.*' => 'nullable|string',
            'sizes' => 'nullable|array',
            'sizes.*' => 'nullable|string',
            'highlight' => ['nullable'],
            'status' => ['nullable'],
            'meta_tag' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ];
    }
}
