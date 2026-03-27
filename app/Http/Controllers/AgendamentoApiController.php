<?php

namespace App\Http\Controllers;

use App\FIlters\AgendamentoFIlter;
use App\Http\Controllers\Resource\AgendamentoResource;
use App\Repository\AgendamentosRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class AgendamentoApiController extends Controller
{
    private $repository;
    private $user;
    public function __construct(AgendamentosRepository $repository, UserRepository $user)
    {
        $this->repository = $repository;
        $this->user = $user;
    }

    //GET /api/eventos - Listar todos os eventos - INDEX => convenção
    public function index(Request $request)
    {
        try {

            $filter = new AgendamentoFIlter($request);
            $perpage = $request->input('perpage', 15);
            $getAgendamento = $this->repository->filterPaginate($filter, $perpage);
            return AgendamentoResource::collection($getAgendamento);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'erro ao listar local',
                'erro' => $ex->getMessage()
            ], 500);
        }
    }


    public function store(Request $request)
    {
        try {

            $dados = $request->all();
            $salvar = $this->repository->salvar($dados);
            return response()->json([
                'message' =>  'local criado com sucesso',
                'data' => new AgendamentoResource($salvar)
            ], 201);
        } catch (\Exception $ex) {
            return response()->json(
                [
                    'message' => 'erro ao criar local',
                    'erro' => $ex->getMessage()
                ],
                500
            );
        }
    }

    /**
     * Display the resource.
     */
    public function show($id)
    {
        try {
            $get =  $this->repository->getId($id);
            return new AgendamentoResource($get);
        } catch (\Exception $ex) {
            return response()
                ->json([
                    'erro' => $ex->getMessage()
                ], 404);
        }
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = $this->repository->getId($id);
        try {

            if (!$id) {
                return response()->json([
                    "message" => 'o id não pôde ser localizado'
                ], 404);
            }
            $local = $request->all();
            $local['id'] = $id;
            $update = $this->repository->salvar($local);
            return response()->json([
                "message" => 'evento atualizado com sucesso',
                'data' => new AgendamentoResource($update)
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "erro" => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy($id) {


        $agendamentoId = $this->repository->getId($id);

            try {

                if (!$agendamentoId) {
                    return response()->json([
                        "message" => 'usuario não encontrado'
                    ], 404);
                } else{

                    $userId = auth('sanctum')->id();
                    if($agendamentoId->user_id !== $userId ){
                        return response()->json(["message" => 'usuario não tem permissão para deletar esse agendamento'
                    ], 403);
                    }
            $this->repository->destroyId($agendamentoId);
                return response()->json(['message' => 'local deletado com sucesso',

            ], 200);}



}catch (\Exception $ex){

    return response()->json(['message' => 'não foi possível deletar o registro',
        'erro' => $ex->getMessage(),

], 500);
}

}



}
