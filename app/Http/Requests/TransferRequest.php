<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transfer_type' => 'required',
            'beneficiary'   => 'required',
            'amount'        => 'required|numeric|min:2000',
        ];
    }

    public function messages()
    {
        return [
            'transfer_type.required' => 'Please select a transfer type',
            'beneficiary.required'   => 'Beneficiary is required',
            'amount.required'        => 'Amount is required',
        ];
    }

}
