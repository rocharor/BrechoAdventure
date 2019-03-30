<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Data\Repositories\Site\ProductRepository;
use App\Data\Repositories\Site\FavoriteRepository;

class HomeController extends Controller
{
    private $repository;
    private $favoriteRepository;

    public function __construct(ProductRepository $repository, FavoriteRepository $favoriteRepository)
    {
        $this->repository = $repository;
        $this->favoriteRepository = $favoriteRepository;
    }

    public function index()
    {
        $this->repository->paginacao = true;
        $produtos = $this->repository->getProdutos();

        $favoritos = $this->favoriteRepository->getFavoritos();
        foreach ($produtos['itens'] as $produto) {
            $produto->imgPrincipal = $this->imagemPrincipal($produto->nm_imagem);

            $produto->favorito = false;
            foreach ($favoritos['itens'] as $favorito) {
                if ($favorito->produto_id == $produto->id) {
                    $produto->favorito = true;
                }
            }
        }

        $produtos['user'] = json_encode([
            'logged' => Auth::check(),
            'id' => Auth::check() ? Auth::user()->id : 0,
        ]);

        return view('site/home', [
            'produtos' => $produtos,
            'breadCrumb' => $this->getBreadCrumb()
        ]);
    }
}
