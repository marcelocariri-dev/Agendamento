<?php

namespace App\FIlters;

class LocalFilter extends QueryFilter
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function nome($value){
         $this->builder->where('nome', 'like', "%{$value}%");
    }
    public function ativo($value){
        $this->builder->where('ativo', (bool)$value);
    }
    public function id($value){
        $this->builder->where('id', 'like', "%{$value}%");
    }


}
