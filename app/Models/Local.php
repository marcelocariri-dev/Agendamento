<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{  protected $table = "locais";
    protected $fillable = [
        'nome',
        'descricao',
        'ativo',


    ];


    protected $casts = [
        'ativo' => 'boolean',

    ];

    // Relacionamentos
    public function Agendamentos(){
        return $this->hasMany(Agendamento::class);
    }
}
