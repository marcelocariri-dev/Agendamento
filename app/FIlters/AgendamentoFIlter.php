<?php

namespace App\FIlters;

class AgendamentoFIlter extends QueryFilter
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }
    public function userid($value){
            $this->builder->where('user_id', 'like', "%{$value}%" );
    }

    public function titulo($value){
        $this->builder->where('nome', 'like', "%{$value}%");
    }

    public function data($value){
        $this->builder->where(function($query) use ($value){

           $query->wheredate('data_inicio', '>=', "%{$value}%")
           ->wheredate('data_final', '<=', "%{$value}%" );
        });


    }


    public function status ($value ){
        $this->builder->where('status', 'like', "%{$value}%");
    }

}
