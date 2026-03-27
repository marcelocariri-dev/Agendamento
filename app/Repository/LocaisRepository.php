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
    public function filterPaginated(Localfilter $filters, int $perpag = 15)
    {
        return $this->model->with(['Agendamentos'])
            ->filter($filters)
            ->orderBy('nome', 'asc')
            ->paginate($perpag);
    }

    public function salvar(array $dados)
    {
        return $this->model->updateOrCreate(
            ['id' => $dados['id'] ?? null],
            $dados

        );
    }

    public function getId(int $id)
    {
        return $this->model->with(['agendamentos' => function ($query) {
            $query->orderBy('data', 'desc')
                ->orderBy('hora_inicio', 'desc');
        }])->find($id);
    }

    public function destroyId (int $id){
        $local = $this->model->findOrFail($id);

        if($local->Agendamentos()->count() <= 0){
           $local->delete();
           return  true;
        } else{
           throw new \Exception('existe agendamentos ligados a esse local');
        }


    }














}
