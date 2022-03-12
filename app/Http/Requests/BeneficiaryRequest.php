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
        if(request()->route('beneficiary.create'))
        {
            $account_no_required = 'required';
            $account_no_unique = 'unique:beneficiaries';
            $name = 'required';
            $routing_number = 'required';
        }else{
            $account_no_required = 'nullable';
            $account_no_unique = '';
            $name = 'nullable';
            $routing_number = 'nullable';
        }
        return [
            'account_no'     => [Rule::when(request()->isMethod('post'), 'required|unique:beneficiaries',),Rule::when(request()->isMethod('post'), 'nullable') ],
            'name'           => [Rule::when(request()->isMethod('post'), 'required'),Rule::when(request()->isMethod('put'), 'nullable')],
//            'phone' => 'required',
            'routing_number' => [Rule::when(request()->isMethod('post'), 'required'),Rule::when(request()->isMethod('put'), 'nullable')],
            'bank_name'      => [Rule::when(request()->isMethod('post'), 'required'),Rule::when(request()->isMethod('put'), 'nullable')],
            'branch_name'    => [Rule::when(request()->isMethod('post'), 'required'),Rule::when(request()->isMethod('put'), 'nullable')],
            'branch_city'    => [Rule::when(request()->isMethod('post'), 'required'),Rule::when(request()->isMethod('put'), 'nullable')],
            'currency'       => [Rule::when(request()->isMethod('post'), 'required'),Rule::when(request()->isMethod('put'), 'nullable')],
        ];
    }
}
