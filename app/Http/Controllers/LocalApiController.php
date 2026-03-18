<?php

namespace App\Http\Controllers;

use App\FIlters\LocalFilter;
use App\Http\Controllers\Resource\LocalResource;
use App\Repository\LocaisRepository;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Psr\Http\Message\ResponseInterface;

class LocalApiController extends Controller

{
    private $repository;
    public function __construct(LocaisRepository $repository)
    {
        $this->repository = $repository;
    }

    //GET /api/eventos - Listar todos os eventos - INDEX => convenção
    public function index(Request $request)
    {
        try {

            $filter = new LocalFilter($request);
            $perpage = $request->input('perpage', 15);
            $getlocal = $this->repository->filterPaginate($filter, $perpage);
            return LocalResource::collection($getlocal);
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
                'data' => new LocalResource($salvar)
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
            return new LocalResource($get);
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
                'data' => new LocalResource($update)
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
    public function destroy($id)
    {     $deletar = $this->repository->getId($id);
            try {

                if (!$id) {
                    return response()->json([
                        "message" => 'o id não pôde ser localizado'
                    ], 404);
            $this->repository->destroyId($deletar);
                return response()->json(['message' => 'local deletado com sucesso',

            ], 204);

    }

}catch (\Exception $ex){

    return response()->json(['message' => 'não foi possível deletar o registro',
        'erro' => $ex->getMessage(),

], 404);
}



}





}