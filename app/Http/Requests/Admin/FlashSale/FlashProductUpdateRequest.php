<?php

namespace App\Http\Requests\Admin\FlashSale;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FlashProductUpdateRequest extends FormRequest
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
        $flashSaleId = $this->route('flash_id'); // Retrieve flash_id from the route parameter
        $productId = $this->route('id'); // Retrieve product id from the route parameter
;
        return [
            'product_id' => [
            'required',
            'integer',
            'exists:products,id',
            Rule::unique('flash_sale_products')
                ->where(function ($query) use ($flashSaleId) {
                return $query->where('flash_sale_id', $flashSaleId);
                })
                ->ignore($productId), // Ignore the current product being updated
            ],
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
        ];
    }
}
