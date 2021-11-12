<?php

namespace VotingSystem\Http\Requests\Importer\Voter;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required',
            'membership_number' => 'required|unique:voters',
            'phone' => 'required|numeric|unique:voters',
            'designation' => 'required',
            'alt_phone' => 'nullable|unique:voters',
            'address' => 'nullable',
            'bank_acc_number' => 'nullable'
        ];
    }
}
