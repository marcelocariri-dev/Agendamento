<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'     => 'required|exists:users,id',
            'local_id'    => 'required|exists:locals,id',
            'titulo'      => 'required|string|max:255',
            'data'        => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_final'  => 'required|date_format:H:i|after:hora_inicio',
            'observacoes' => 'nullable|string|max:1000',
            'status'      => 'nullable|in:pendente,confirmado,cancelado',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required'      => 'O usuário é obrigatório.',
            'user_id.exists'        => 'O usuário informado não existe.',
            'local_id.required'     => 'O local é obrigatório.',
            'local_id.exists'       => 'O local informado não existe.',
            'titulo.required'       => 'O título é obrigatório.',
            'titulo.max'            => 'O título deve ter no máximo 255 caracteres.',
            'data.required'         => 'A data é obrigatória.',
            'data.date'             => 'A data informada não é válida.',
            'data.after_or_equal'   => 'A data não pode ser anterior a hoje.',
            'hora_inicio.required'  => 'A hora de início é obrigatória.',
            'hora_inicio.date_format' => 'A hora de início deve estar no formato HH:MM.',
            'hora_final.required'   => 'A hora final é obrigatória.',
            'hora_final.date_format'  => 'A hora final deve estar no formato HH:MM.',
            'hora_final.after'      => 'A hora final deve ser posterior à hora de início.',
            'observacoes.max'       => 'As observações devem ter no máximo 1000 caracteres.',
            'status.in'             => 'O status deve ser: pendente, confirmado ou cancelado.',
        ];
    }
}