<?php

namespace App\Http\Requests\Admin\FlashSale;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FlashProductCreateRequest extends FormRequest
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
            'product_id' => [
                'required',
                'integer',
                'exists:products,id',
                Rule::unique('flash_sale_products', 'product_id')->where(function ($query) {
                    return $query->where('flash_sale_id', $this->route('product'));
                }),
            ],
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
        ];
    }
}
