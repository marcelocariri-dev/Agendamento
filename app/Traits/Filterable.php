<?php

namespace App\Traits;

use App\FIlters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $query, QueryFilter $filters){
    return $filters->apply($query);
    }
}
