<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioStore extends FormRequest
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
            'nome'              => 'required',
            'experiencia_id'    => 'required',
            'formacao_id'       => 'required',
            'email'             => 'nullable',
            'telefone'          => 'nullable|max:11'
        ];
    }
}
