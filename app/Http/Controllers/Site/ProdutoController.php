<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Produto;
use App\Models\Site\Favorito;
use App\Models\Categoria;
use App\Mail\BrechoMail;
use App\Services\UploadImagem;

class ProdutoController extends Controller
{
    use UploadImagem;

    public $model;
    // public $totalPagina = 8;

    public function __construct(Produto $produto)
    {
        $this->model = $produto;
    }

    public function index(Favorito $favorito)
    {
        $this->model->paginacao = true;
        $produtos = $this->model->getProdutos();

        $favoritos = $favorito->getFavoritos();
        foreach($produtos['itens'] as $produto){
            $produto->imgPrincipal = $this->imagemPrincipal($produto->nm_imagem);

            $produto->favorito = false;
            foreach($favoritos['itens'] as $favorito){
                if($favorito->produto_id == $produto->id){
                    $produto->favorito = true;
                }
            }
        }

        return view('site/home',[
            'produtos'=>$produtos['itens'],
            'breadCrumb' => $this->getBreadCrumb()
        ]);

    }

    public function produtos(Favorito $favorito, Request $request, $pagina=1)
    {
        if (count($request->all()) > 0) {
            foreach ($request->all() as $key => $value) {
                $parametros[$key] = explode(',',$value);
            }
            $this->model->parametros = $parametros;
        }

        $this->model->paginacao = true;
        $this->model->pagina = $pagina;
        $produtos = $this->model->getProdutos();
        $numberPages = (int)ceil($produtos['total'] / $this->model->totalPagina);

        $favoritos = $favorito->getFavoritos();
        foreach($produtos['itens'] as $produto){
            $produto->imgPrincipal = $this->imagemPrincipal($produto->nm_imagem);

            $produto->favorito = false;
            foreach($favoritos['itens'] as $favorito){
                if($favorito->produto_id == $produto->id){
                    $produto->favorito = true;
                }
            }
        }

        return view('site/produtos',[
            'produtos' => $produtos['itens'],
            'pg' => $pagina,
            'numberPages' => $numberPages,
            'link' => '/produtos/',
            'breadCrumb' => $this->getBreadCrumb()
        ]);
    }

    public function meusProdutos($pagina=1)
    {
        $this->model->paginacao = true;
        $this->model->pagina = $pagina;
        $meusProdutos = $this->model->getMeusProdutos();
        $numberPages = (int)ceil($meusProdutos['total'] / $this->model->totalPagina);

        foreach($meusProdutos['itens'] as $produto){
            $produto->imgPrincipal = $this->imagemPrincipal($produto->nm_imagem);
            $produto->dataExibicao = $this->formataDataExibicao($produto->updated_at);
        }

        return view('minhaConta/produto',[
            'meusProdutos'=>$meusProdutos['itens'],
            'pg'=>$pagina,
            'numberPages'=>$numberPages,
            'link'=>'/minha-conta/produto/',
            'breadCrumb' => $this->getBreadCrumb()
        ]);
    }

    public function create(Categoria $categoria)
    {
        $autorizado = false;
        if(Auth::user()->dt_nascimento && (Auth::user()->telefone_fixo || Auth::user()->telefone_cel)){
            $autorizado = true;
        }

        $categorias = $categoria->all();

        return view('minhaConta/cadastroProduto',[
            'autorizado'=>$autorizado,
            'categorias'=>$categorias,
            'breadCrumb' => $this->getBreadCrumb()
        ]);
    }

    public function store(Request $request)
    {
        $nome_imagem = [];

        foreach($request->foto as $key=>$foto){
            $novoNome = $this->imagemProduto($foto);
            $nome_imagem[] = $novoNome;
            // $ext = $foto->extension();
            // if($this->validaExtImagem($ext)){
            //     $user_id = Auth::user()->id;
            //     $foto_nome = $key . '_' . $user_id . '_' . date('dmYhis') . '.' . $ext;
            //     $foto_salva = $foto->move(public_path("imagens\produtos"), $foto_nome);
            //     $nome_imagem[] = $foto_nome;
            // }
        }

        if (count($nome_imagem) > 0) {
        // if ($foto_salva) {
            $this->model->user_id = $user_id;
            $this->model->categoria_id = $request->get('categoria');
            $this->model->titulo = $request->get('titulo');
            $this->model->descricao = $request->get('descricao');
            $this->model->valor = $request->get('valor');
            $this->model->estado = $request->get('tipo');
            $this->model->nm_imagem = implode('|',$nome_imagem);
            if($this->model->save()){
                return redirect()->route('minha-conta.create-produto')->with('sucesso','Produro inserido com sucesso.');
            }
        }

        return redirect()->route('minha-conta.create-produto')->with('erro','Erro ao salvar produto, tente novamente!');

    }

    public function show($param)
    {
        $this->getBreadCrumb();
        $produto = $this->model->getProduto($param);

        $imagens = [];
        if ($produto->nm_imagem != '') {
            $imagens = explode('|',$produto->nm_imagem);
        }

        $produto->imagens = $imagens;
        $produto->inserido = $this->formataDataExibicao($produto->updated_at);

        return view('site/visualizarProduto',[
            'produto'=>$produto,
            'breadCrumb' => $this->getBreadCrumb()
        ]);
    }

    public function edit($param, Categoria $categoria)
    {
        $produto = $this->model->getProduto($param);
        $categorias = $categoria->all();

        $imagens = [];
        if ($produto->nm_imagem != '') {
            $imagens = explode('|',$produto->nm_imagem);
        }

        $produto->imagens = $imagens;
        $produto->dataExibicao = $this->formataDataExibicao($produto->created_at, false);

        return view('minhaConta/editarProduto',[
            'categorias'=>$categorias,
            'produto'=>$produto,
            'breadCrumb' => $this->getBreadCrumb()
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'categoria' => 'required',
            'descricao' => 'required',
            'estado' => 'required',
            'valor' => 'required'
        ]);

        $produto = $this->model->find($request->produto_id);

        $produto->categoria_id = $request->get('categoria');
        $produto->titulo = $request->get('titulo');
        $produto->descricao = $request->get('descricao');
        $produto->valor = $this->formataMoedaBD($request->get('valor'));
        $produto->estado = $request->get('estado');
        $produto->status = 2;
        $nome_imagem = [$produto->nm_imagem];

        if (!is_null($request->imagemProduto)) {
            foreach($request->imagemProduto as $key=>$foto){
                $novoNome = $this->imagemProduto($foto);
                $nome_imagem[] = $novoNome;
                // $foto_salva = $foto->move(public_path("imagens/produtos"), $foto_nome);
            }
            if (count($nome_imagem) > 1 && in_array('sem-imagem.gif', $nome_imagem)) {
                $chave = array_search('sem-imagem.gif', $nome_imagem);
                unset($nome_imagem[$chave]);
            }

            $produto->nm_imagem = implode('|',$nome_imagem);
        }

        if ($produto->save()) {
            return redirect()->route('minha-conta.meus-produto')->with('sucesso','Salvo com sucesso!');
        };

        return redirect()->route('minha-conta.meus-produto')->with('erro','Erro ao salvar, tente novamente!');
    }

    public function deletePhoto(Request $request)
    {
        $produto = $this->model->find($request->get('produto_id'));

        $retorno = ['sucesso'=>0,'msg'=>'Erro ao excluir foto'];
        if (Auth::user()->id == $produto->user_id && $produto->nm_imagem != 'sem-imagem.gif') {
            $arrFotos = explode('|',$produto->nm_imagem);
            $key = array_search($request->get('nm_foto'),$arrFotos);
            unset($arrFotos[$key]);
            if (count($arrFotos) > 0) {
                $nm_imagem = implode('|',$arrFotos);
            }else{
                $nm_imagem = 'sem-imagem.gif';
            }

            $produto->nm_imagem = $nm_imagem;

            if($produto->save()){
                if ($this->deleteImagemProduto($request->nm_foto)){
                    $retorno = ['sucesso'=>1,'msg'=>'Foto excluída com sucesso'];
                }
            }

        }

        echo json_encode($retorno);
        die();

    }

    public function delete($id)
    {
        $produto = $this->model->find($id);
        $retorno = 0;
        if (Auth::user()->id == $produto->user_id) {
            $retorno = $produto->delete();
        }
        echo $retorno;
        die();
    }

    public function getFiltro(Request $request)
    {

        if (count($request->parametro) > 0) {
            foreach ($request->parametro as $key => $value) {
                $parametros[$key] = explode(',',$value);
            }
            $this->model->parametros = $parametros;
        }

        $retorno = $this->model->mountFilter();

        echo response()->json($retorno)->content();
        die();
    }

    // public function getCacheFilter(Cache $cache)
    // {
    //     $cache->deleteCache('products');
    //     $cache->updateCacheAll();
    //     $products = collect(json_decode($products,true));
    //     echo json_decode($cache->getCache('filter'),true);
    //     echo $cache->getCache('filter');
    //     die();
    // }   

}
