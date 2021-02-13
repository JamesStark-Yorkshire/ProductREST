<?php

namespace App\Http\Requests\Product;

use Anik\Form\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'product_name' => ['required', 'string', 'max:255'],
            'product_desc' => ['required', 'string'],
            'product_category' => ['required', 'string', 'max:20'],
            'product_price' => ['required', 'numeric', 'min:0', 'max:99999999']
        ];
    }
}
