<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FlashSaleUpdateRequest extends FormRequest
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

        if($this->route('flash-sale')){
            $id = $this->route('flash-sale');
        }
        else{
            $id = $this->route()->parameters()['id'];
        }
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('flash_sales')->ignore($id),
            ],
            'start_date' => 'required|date|before:end_time',
            'end_time' => 'required|date|after:start_date',
            'is_current' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
