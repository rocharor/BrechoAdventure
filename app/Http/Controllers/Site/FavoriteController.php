<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Data\Repositories\Site\FavoriteRepository;

class FavoriteController extends Controller
{
    private $repository;

    public function __construct(FavoriteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($pagina = 1)
    {
        $this->repository->paginacao = true;
        $this->repository->pagina = $pagina;
        $favoritos = $this->repository->getFavoritos();

        foreach ($favoritos['itens'] as $favorito) {
            $favorito->produto->imgPrincipal = $this->imagemPrincipal($favorito->produto->nm_imagem);
        }

        $numberPages = (int)ceil($favoritos['total'] / $this->repository->totalPagina);

        return view('minhaConta/favorito', [
            'favoritos' => $favoritos['itens'],
            'breadCrumb' => $this->getBreadCrumb(),
            'pg' => $pagina,
            'numberPages' => $numberPages,
            'link' => '/minha-conta/favorito/'
        ]);
    }

    public function store(Request $request)
    {
        $response = $this->repository->store($request);

        return $response;
    }

    public function delete(Request $request)
    {
        $response = $this->repository->delete($request);

        if ($response) {
            return redirect()->route('minha-conta.meus-favorito', 1)->with('sucesso', 'Favorito excluido com sucesso.');
        }
        return redirect()->route('minha-conta.meus-favorito', 1)->with('erro', 'Erro ao excluir favorito.');
    }
}
