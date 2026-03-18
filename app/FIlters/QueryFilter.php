<?php

namespace App\FIlters;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter
{
    protected $request;
    protected $builder;
    public function __construct(Request $request)
    {
        $this->request =  $request;
    }

    public function apply (Builder $builder){

      $this->builder = $builder;

        foreach ($this->filters() as $filter => $value) {
            $methodName = $this->convertToCamelCase($filter);
            if(method_exists($this, $methodName)){
                 $this->$methodName($value);
            }
        }

return $this->builder;

    }
public function filters (){
   return $this->request->all();

}
public function convertToCamelCase($string){
    return lcfirst(str_replace("_", "", ucwords($string, "_")));
}

}
