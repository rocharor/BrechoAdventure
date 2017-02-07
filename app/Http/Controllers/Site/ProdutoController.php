<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Produto;
use App\Models\Site\Favorito;
use App\Models\Categoria;
use App\Services\Util;

class ProdutoController extends Controller
{
    use Util;

    public $model;
    public $totalPagina = 8;

    public function __construct(Produto $produto)
    {
        $this->model = $produto;
    }

    /**
     * Abre pagina de produtos
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Favorito $favorito)
    {
        $produtos = $this->model->getProdutos($this->totalPagina);

        $favoritos = $favorito->getFavoritos();
        foreach($produtos as $produto){
            $arrImg = explode('|',$produto->nm_imagem);
            $produto->imgPrincipal = $arrImg[0];
            $produto->favorito = false;
            foreach($favoritos as $favorito){
                if($favorito->produto_id == $produto->id){
                    $produto->favorito = true;
                }
            }
        }

        return view('site/produto',['produtos'=>$produtos]);
    }

    /**
     * Abre pagina de todos os produtos
     *
     * @return \Illuminate\Http\Response
     */
    public function todosProdutosIndex($pg, Favorito $favorito,Request $request)
    {
        // dd(Request::route()->getName());
        $totalProdutos = count($this->model->getProdutos());
        $paginacao = (int)ceil($totalProdutos / $this->totalPagina);

        $limit = Util::geraLimitPaginacao($pg,$this->totalPagina);
        $produtos = $this->model->getProdutos($limit['inicio'],$limit['fim']);
        $favoritos = $favorito->getFavoritos();
        foreach($produtos as $produto){
            $arrImg = explode('|',$produto->nm_imagem);
            $produto->imgPrincipal = $arrImg[0];
            $produto->favorito = false;
            foreach($favoritos as $favorito){
                if($favorito->produto_id == $produto->id){
                    $produto->favorito = true;
                }
            }
        }

        return view('site/todosProdutos',['produtos'=>$produtos,'pg'=>$pg,'totalProdutos'=>$paginacao]);
    }

    /**
     * Abre pagina de produtos (Minha Conta)
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMC()
    {
        $meusProdutos = $this->model->getMeusProdutos();

        foreach($meusProdutos as $produto){
            $arrImg = explode('|',$produto->nm_imagem);
            $produto->imgPrincipal = $arrImg[0];
            // $produto->favorito = false;
            // foreach($favoritos as $favorito){
                // if($favorito->produto_id == $produto->id){
                    // $produto->favorito = true;
                // }
            // }
        }

        return view('minhaConta/produto',['meusProdutos'=>$meusProdutos]);
    }

    /**
     * Abre pagina para cadastrar produto
     *
     * @return \Illuminate\Http\Response
     */
    public function cadastroIndex(Categoria $categoria)
    {
        $autorizado = false;
        if(Auth::user()->dt_nascimento && (Auth::user()->telefone_fixo || Auth::user()->telefone_cel)){
            $autorizado = true;
        }

        $categorias = $categoria->all();

        return view('minhaConta/cadastroProduto',['autorizado'=>$autorizado,'categorias'=>$categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
            $foto_salva = false;
            $nome_imagem = [];

            foreach($request->foto as $key=>$foto){
                // if ($foto->hasFile('foto') &&  $foto->file('foto')->isValid()){
                    $ext = $foto->extension();
                    if($this->validaExtImagem($ext)){
                        $user_id = Auth::user()->id;
                        $foto_nome = $key . '_' . $user_id . '_' . date('dmYhis') . '.' . $ext;
                        $foto_salva = $foto->move(public_path("imagens\produtos"), $foto_nome);
                        $nome_imagem[] = $foto_nome;
                    }
                // }

        }

        if ($foto_salva) {
            $this->model->user_id = $user_id;
            $this->model->categoria_id = $request->get('categoria');
            $this->model->titulo = $request->get('titulo');
            $this->model->descricao = $request->get('descricao');
            $this->model->valor = $request->get('valor');
            $this->model->estado = $request->get('tipo');
            $this->model->nm_imagem = implode('|',$nome_imagem);
            if($this->model->save()){
                return redirect()->route('minha-conta.cadastro-produto')->with('sucesso','Produro inserido com sucesso.');
            }
        }

        return redirect()->route('minha-conta.cadastro-produto')->with('erro','Erro ao salvar produto, tente novamente!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Traz os dados do produto
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $produto_id = $request->get('produto_id');
        $produtos = $this->model->getDescricaoProduto($produto_id);

        //echo response($produtos)->content();
        echo response()->json($produtos)->content();
        die();
    }

    /**
     * Abre pagina para editar
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Categoria $categoria)
    {

        $produto = $this->model->find($id);
        $categorias = $categoria->all();

        $imagens = [];
        if ($produto->nm_imagem != '') {
            $imagens = explode('|',$produto->nm_imagem);
        }

        $produto->imagens = $imagens;

        return view('minhaConta/editarProduto',['categorias'=>$categorias,'produto'=>$produto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $produto = $this->model->find($id);

        $produto->categoria_id = $request->get('categoria');
        $produto->titulo = $request->get('titulo');
        $produto->descricao = $request->get('descricao');
        $produto->valor = Util::formataMoedaBD($request->get('valor'));
        $produto->estado = $request->get('estado');
        // $produto->nm_imagem = '';
        // $produto->status = 2;
        //
        if ($produto->save()) {
            return redirect()->route('minha-conta.mcproduto')->with('sucesso','Salvo com sucesso!');
        };

        return redirect()->route('minha-conta.mcproduto')->with('erro','Erro ao salvar, tente novamente!');
    }

    /**
     * Desativa produto
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = $this->model->find($id);
        $produto->status = 0;

        if ($produto->save()) {
            echo 1;
            die();
        }

        echo 0;
        die();
    }
}
