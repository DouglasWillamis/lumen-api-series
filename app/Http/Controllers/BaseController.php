<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends Controller
{

    protected $classe;

    public function index(Request $request)
    {
        $series = $this->classe::paginate($request->per_page);
        return response()->json($series, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        return response()
            ->json($this->classe::create($request->all()), Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $recurso = $this->classe::find($id);
        if (is_null($recurso)) {
            return response()
                ->json('', Response::HTTP_NO_CONTENT);
        }

        return response()
            ->json($recurso, Response::HTTP_OK);

    }

    public function update(int $id, Request $request)
    {
        $recurso = $this->classe::find($id);
        if (is_null($recurso)) {
            return response()->json([
                'erro' => 'Recurso não encontrado'
            ], Response::HTTP_NOT_FOUND);
        }
        $recurso->fill($request->all());
        $recurso->save();
        return response()->json($recurso, Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $qtdRecursosRemovidos = $this->classe::destroy($id);
        if ($qtdRecursosRemovidos === 0) {
            return response()->json([
                'erro' => 'Recurso não encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
