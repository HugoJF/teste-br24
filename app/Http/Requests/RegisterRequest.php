<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required',
            'surname' => 'required',
            'phone'   => 'required|celular_com_ddd',
            'email'   => 'required|email',
            'cpf'     => 'required|cpf',
            'company' => 'required',
            'cnpj'    => 'required|cnpj',
        ];
    }

    public function companyInput()
    {
        $data = $this->only(['company', 'cnpj']);

        return rename_array($data, ['company' => 'name']);
    }

    public function contactInput()
    {
        return $this->only(['name', 'surname', 'phone', 'email', 'cpf']);
    }
}
