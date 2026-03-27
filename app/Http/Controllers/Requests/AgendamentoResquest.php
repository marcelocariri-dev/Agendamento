<?php

namespace App\Http\Controllers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendamentoRequest extends FormRequest
{
    /**
     * Create a new class instance.
     */
    public function authorize(){
        return true;
    }

    public function rules(): array{
        return [
        'user_id' => 'requerid|exists:users,id',
        'local_id',
        'titulo',
        'data',
        'hora_inicio',
        'hora_final',
        'observacoes',
        'status'

        ];



    }


}
