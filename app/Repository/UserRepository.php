<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;

class UserRepository extends Repository
{
   private $model;
    public function __construct()
    {
        $this->model = new User();
    }
public function  filterPaginated(Request $request, int $perpage){
 return $this->model->with('agendamentos')
 ->orderBy('nome', 'asc')
 ->filter($request)
 ->paginate($perpage); //paginate já serve como get

}
    public function getId($id){

        return $this->model->with('agendamentos')
        ->orderBy('nome', 'desc')->find($id);
    }

    public function salvar ($dados){

    return $this->model->updateOrCreate(['id' => $dados['id'] ?? null ],
    $dados);

    }


    public function destroyId ($id){
        $users = $this->model->findOrFail($id);

        if($users->agendamentos()->count() <= 0){
           $users->delete();
           return  true;
        } else{
           throw new \Exception('existe agendamentos ligados a esse users');
        }


    }












}
