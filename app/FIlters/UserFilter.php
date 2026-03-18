<?php

namespace App\FIlters;

class UserFilter extends QueryFilter
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
public function nome($value){
    $this->builder->where('nome', 'like', "%{$value}$");

}

public function userid($value){
    $this->builder->where('user_id', 'like', "%{$value}%");
}


}
