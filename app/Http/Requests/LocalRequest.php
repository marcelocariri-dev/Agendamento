<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalRequest extends FormRequest
{
    /**
     * Create a new class instance.
     */
    public function authorize(){
        return true;
    }

    public function rules(): array{
        return [
        'nome' => 'required|string|max:255',
        'descrição' => 'required|string|max:255',
        'ativo' => 'boolean'
        ];



    }


}
