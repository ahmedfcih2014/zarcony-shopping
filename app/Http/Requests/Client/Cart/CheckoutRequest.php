<?php

namespace App\Http\Requests\Client\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->isClientAuth();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address_line' => 'required',
            'mobile' => 'required',
            'payment_id' => 'required|exists:payment_methods,id'
        ];
    }
}
