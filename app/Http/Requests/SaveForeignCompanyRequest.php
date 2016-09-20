<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveForeignCompanyRequest extends Request
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
            'fc_name' => 'required',
            'fc_url' => 'required',
            'fc_logo_url' => 'required'
        ];
    }
}
