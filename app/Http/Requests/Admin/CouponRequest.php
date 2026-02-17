<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'code' => [
                'required',
                'string',
                'max:255',
            ],
            'type' => 'required|in:1,2', // 1 for fixed, 2 for percentage
            'value' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'expires_at' => 'nullable|date|after_or_equal:now',
            'usage_limit' => 'nullable|integer|min:1',
            'is_active' => 'required|boolean',
        ];

        // Apply unique rule for 'code' based on whether it's a store or update request
        if ($this->method() === 'PUT') {
            // For update, ignore the current coupon's ID
            $rules['code'][] = Rule::unique('coupons', 'code')->ignore($this->route('coupon'));
        } else {
            // For store, simply check for uniqueness
            $rules['code'][] = 'unique:coupons,code';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'code.required' => 'The coupon code is required.',
            'code.unique' => 'This coupon code has already been taken.',
            'type.required' => 'The coupon type is required.',
            'type.in' => 'Invalid coupon type selected.',
            'value.required' => 'The discount value is required.',
            'value.numeric' => 'The discount value must be a number.',
            'value.min' => 'The discount value must be at least 0.',
            'min_amount.numeric' => 'The minimum amount must be a number.',
            'min_amount.min' => 'The minimum amount must be at least 0.',
            'expires_at.date' => 'The expiration date must be a valid date.',
            'expires_at.after_or_equal' => 'The expiration date must be today or a future date.',
            'usage_limit.integer' => 'The usage limit must be an integer.',
            'usage_limit.min' => 'The usage limit must be at least 1.',
            'is_active.required' => 'The active status is required.',
            'is_active.boolean' => 'The active status must be true or false.',
        ];
    }
}
