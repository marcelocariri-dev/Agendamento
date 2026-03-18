<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{ protected $table = "agendamentos";
    protected $fillable = [
        'user_id',
        'local_id',
        'titulo',
        'data',
        'hora_inicio',
        'hora_final',
        'observacoes',
        'status'


    ];

    //relacionamentos

    public function locais(){
       $this->belongsTo(Local::class);
    }

    public function Users(){
        $this->belongsTo(User::class);
     }

}
