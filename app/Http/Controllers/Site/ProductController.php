<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Data\Repositories\Site\ProductRepository;
use App\Data\Repositories\Site\FavoriteRepository;

class ProductController extends Controller
{
    private $repository;
    private $favoriteRepository;

    public function __construct(ProductRepository $repository, FavoriteRepository $favoriteRepository)
    {
        $this->repository = $repository;
        $this->favoriteRepository = $favoriteRepository;
    }

    public function index(Request $request, $pagina = 1)
    {
        if (count($request->all()) > 0) {
            foreach ($request->all() as $key => $value) {
                $parametros[$key] = explode(',', $value);
            }
            $this->repository->parametros = $parametros;
        }

        $this->repository->paginacao = true;
        $this->repository->pagina = $pagina;
        $produtos = $this->repository->getProdutos();
        $numberPages = (int)ceil($produtos['total'] / $this->repository->totalPagina);

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

        return view('site/product', [
            'produtos' => $produtos,
            'pg' => $pagina,
            'numberPages' => $numberPages,
            'link' => Route('product') . '/',
            'breadCrumb' => $this->getBreadCrumb()
        ]);
    }

    public function show($param)
    {
        $this->getBreadCrumb();
        $produto = $this->repository->getProduto($param);

        $imagens = [];
        if ($produto->nm_imagem != '') {
            $imagens = explode('|', $produto->nm_imagem);
        }

        $produto->imagens_json = json_encode($imagens);
        $produto->inserido = $this->formataDataExibicao($produto->updated_at);

        return view('site/productView', [
            'produto' => $produto,
            'breadCrumb' => $this->getBreadCrumb()
        ]);
    }

    public function getFiltro(Request $request)
    {
        if (count($request->parametro) > 0) {
            foreach ($request->parametro as $key => $value) {
                $parametros[$key] = explode(',', $value);
            }
            $this->repository->parametros = $parametros;
        }

        $retorno = $this->repository->mountFilter();

        echo response()->json($retorno)->content();
        die();
    }
}
