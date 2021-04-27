<?php

namespace App\Http\Requests\Adm;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StadiumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->type === 'adm';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'country_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome obrigatório.',
            'country_id.required' => 'Selecione o país.',
        ];
    }
}
