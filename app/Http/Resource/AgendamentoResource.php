<?php

namespace App\Http\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Request;

class AgendamentoResource extends JsonResource
{
 public function toArray (Request $request){
    return [
'user_id' => $this-> user_id,
        'local_id' => $this-> local_id,
        'titulo' => $this-> titulo,
        'data' => $this->data ,
        'hora_inicio' => $this->hora_inicio ,
        'hora_final' => $this->hora_final,
        'observacoes' => $this->observacoes,
        'status' =>$this->status


    ];
 }
}
