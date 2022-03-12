<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RechargeRequest extends FormRequest
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
        if ($this->operator_name == 'grameenphone') {
            $rules = ['required', 'digits:11', 'regex:/^((017)|(013))\d{8}$/'];
        } elseif ($this->operator_name == 'banglalink') {
            $rules = ['required', 'digits:11', 'regex:/^((019)|(014))\d{8}$/'];
        } elseif ($this->operator_name == 'airtel') {
            $rules = ['required', 'digits:11', 'regex:/^016\d{8}$/'];
        } elseif ($this->operator_name == 'robi') {
            $rules = ['required', 'digits:11', 'regex:/^018\d{8}$/'];
        } elseif ($this->operator_name == 'teletalk') {
            $rules = ['required', 'digits:11', 'regex:/^015\d{8}$/'];
        }

        return [
            'operator_name' => ['required', 'string'],
            'phone_number' => $rules,
            'balance' => ['required', 'integer', 'min:10', 'max:100'],
        ];
    }
}
