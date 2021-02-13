<?php

namespace App\Http\Requests\Product;

use Anik\Form\FormRequest;

class UpdateRequest extends FormRequest
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
            'product_name' => ['string', 'max:255'],
            'product_desc' => ['string'],
            'product_category' => ['string', 'max:20'],
            'product_price' => ['numeric', 'min:0', 'max:99999999']
        ];
    }
}
