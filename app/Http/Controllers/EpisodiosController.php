<?php


namespace App\Http\Controllers;


use App\Episodio;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EpisodiosController extends BaseController
{
    public function __construct()
    {
        $this->classe = Episodio::class;
    }

    public function buscaPorSerie(int $serieId, Request $request)
    {
        $episodios = Episodio::query()
            ->where('serie_id', $serieId)
            ->paginate($request->per_page);
        return response()->json($episodios, Response::HTTP_OK);
    }
}
