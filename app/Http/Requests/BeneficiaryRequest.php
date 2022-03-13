<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BeneficiaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_no'     => ['required',Rule::unique('beneficiaries')->ignore($this->beneficiary)],
            'name'           => ['required','string'],
            'routing_number' => ['required','string'],
            'bank_name'      => ['required','string'],
            'branch_name'    => ['required','string'],
            'branch_city'    => ['required','string'],
            'currency'       => ['required','string'],
        ];
    }
}
