<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createWithPriceModifiersRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'price_modifiers' => 'sometimes|array',
            'price_modifiers.*.user_type' => 'required_with:price_modifiers|distinct|in:gold,silver,normal',
            'price_modifiers.*.value' => 'required_with:price_modifiers|numeric',
            'price_modifiers.*.is_percentage' => 'required_with:price_modifiers|boolean',
        ];
    }
}
