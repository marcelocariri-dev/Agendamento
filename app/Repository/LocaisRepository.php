<?php

namespace App\Repository;

use App\Models\Local;
use app\FIlters\LocalFilter;
use Illuminate\Cache\Repository;

class LocaisRepository extends Repository
{
    private $model;
    public function __construct()
    {
        $this->model = new Local();
    }
    public function filterPaginate(Localfilter $filters, $perpag = '15')
    {
        return $this->model->with(['Agendamentos'])
            ->filter($filters)
            ->orderBy('nome', 'asc')
            ->get();
    }

    public function salvar($dados)
    {
        return $this->model->updateOrCreate(
            ['id' => $dados['id'] ?? null],
            $dados

        );
    }

    public function getId($id)
    {
        return $this->model->with(['agendamentos' => function ($query) {
            $query->orderBy('data', 'desc')
                ->orderBy('hora_inicio', 'desc');
        }])->find($id);
    }

    public function destroyId ($id){
        if($this->model->Agendamentos()->count() > 0){
           $delete =  $this->model->destroy($id);
           return  true;
        } else{
           throw new \Exception('existe agendamentos ligados a esse local');
        }


    }
}
