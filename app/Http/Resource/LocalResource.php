<?php

namespace App\Http\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocalResource extends JsonResource
{
   //transformando resposta em array

   public function toArray(Request $request)
   {
    return [
        'id' => $this->id,
         'nome' => $this->nome,
    'descricao' => $this->descricao,
        'ativo' => $this->ativo,

        'criado_em' => $this->created_at->format('Y-m-d H:i:s'),
        'atualizado_em' => $this->updated_at->format('Y-m-d H:i:s'),

    ];
   }

}
