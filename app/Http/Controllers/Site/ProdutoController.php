<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Produto;
use App\Models\Site\Favorito;
use App\Models\Categoria;
use App\Services\Util;
use File;
use App\Services\Memcached;

class ProdutoController extends Controller
{
    use Util;

    public $model;
    public $totalPagina = 8;

    public function __construct(Produto $produto)
    {
        $this->model = $produto;
    }

    public function index(Favorito $favorito)
    {
        return view('email.adminProduto');
        die();
        // $produtos = $this->model->getProdutos($this->totalPagina);
        $produtos = $this->getProducts($this->totalPagina);

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

    public function todosProdutos($pg, Favorito $favorito,Request $request)
    {
        // dd(Request::route()->getName());
        // $totalProdutos = count($this->model->getProdutos());

        $totalProdutos = count($this->getProducts());
        $paginacao = (int)ceil($totalProdutos / $this->totalPagina);

        $limit = Util::geraLimitPaginacao($pg,$this->totalPagina);
        // $produtos = $this->model->getProdutos($limit['inicio'],$limit['fim']);

        $produtos = $this->getProducts($limit['inicio'],$limit['fim']);
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

    public function meusProdutos()
    {
        $meusProdutos = $this->model->getMeusProdutos();

        foreach($meusProdutos as $produto){
            $arrImg = explode('|',$produto->nm_imagem);
            $produto->imgPrincipal = $arrImg[0];
            $produto->dataExibicao = Util::formataDataExibicao($produto->created_at);
        }

        return view('minhaConta/produto',['meusProdutos'=>$meusProdutos]);
    }

    public function create(Categoria $categoria)
    {
        $autorizado = false;
        if(Auth::user()->dt_nascimento && (Auth::user()->telefone_fixo || Auth::user()->telefone_cel)){
            $autorizado = true;
        }

        $categorias = $categoria->all();

        return view('minhaConta/cadastroProduto',['autorizado'=>$autorizado,'categorias'=>$categorias]);
    }

    public function store(Request $request)
    {
        $foto_salva = false;
        $nome_imagem = [];

        foreach($request->foto as $key=>$foto){
            $ext = $foto->extension();
            if($this->validaExtImagem($ext)){
                $user_id = Auth::user()->id;
                $foto_nome = $key . '_' . $user_id . '_' . date('dmYhis') . '.' . $ext;
                $foto_salva = $foto->move(public_path("imagens\produtos"), $foto_nome);
                $nome_imagem[] = $foto_nome;
            }
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
                return redirect()->route('minha-conta.createProduto')->with('sucesso','Produro inserido com sucesso.');
            }
        }

        return redirect()->route('minha-conta.createProduto')->with('erro','Erro ao salvar produto, tente novamente!');

    }

    public function show(Request $request)
    {
        $produto_id = $request->get('produto_id');
        $produtos = $this->model->getDescricaoProduto($produto_id);

        //echo response($produtos)->content();
        echo response()->json($produtos)->content();
        die();
    }

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

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'categoria' => 'required',
            'descricao' => 'required',
            'estado' => 'required',
            'valor' => 'required'
        ]);

        $produto = $this->model->find($id);

        $produto->categoria_id = $request->get('categoria');
        $produto->titulo = $request->get('titulo');
        $produto->descricao = $request->get('descricao');
        $produto->valor = Util::formataMoedaBD($request->get('valor'));
        $produto->estado = $request->get('estado');
        $produto->status = 2;
        $nome_imagem[] = $produto->nm_imagem;

        if (!is_null($request->imagemProduto)) {
            foreach($request->imagemProduto as $key=>$foto){
                $ext = $foto->extension();
                if($this->validaExtImagem($ext)){
                    $user_id = Auth::user()->id;
                    $foto_nome = $key . '_' . $user_id . '_' . date('dmYhis') . '.' . $ext;
                    $foto_salva = $foto->move(public_path("imagens/produtos"), $foto_nome);
                    $nome_imagem[] = $foto_nome;
                }
            }

            $produto->nm_imagem = implode('|',$nome_imagem);
        }

        if ($produto->save()) {
            return redirect()->route('minha-conta.editar-produto',$id)->with('sucesso','Salvo com sucesso!');
        };

        return redirect()->route('minha-conta.editar-produto',$id)->with('erro','Erro ao salvar, tente novamente!');
    }

    public function deletePhoto(Request $request)
    {
        $produto = $this->model->find($request->get('produto_id'));

        $retorno = ['sucesso'=>false,'msg'=>'Erro ao excluir foto'];
        if (Auth::user()->id == $produto->user_id) {
            $arrFotos = explode('|',$produto->nm_imagem);
            $key = array_search($request->get('nm_foto'),$arrFotos);
            unset($arrFotos[$key]);
            $nm_imagem = implode('|',$arrFotos);
            $produto->nm_imagem = $nm_imagem;

            if($produto->save()){
                $filename = public_path("imagens/produtos/" . $request->get('nm_foto'));
                File::delete($filename);
                $retorno = ['sucesso'=>true,'msg'=>'Foto excluída com sucesso'];
            }

        }

        echo json_encode($retorno);
        die();

    }

    public function destroy($id)
    {
        $produto = $this->model->find($id);
        $retorno = 0;
        if (Auth::user()->id == $produto->user_id) {
            $retorno = $produto->delete();
            // $produto->status = 0;
            // if ($produto->save()) {
                // $retorno = 1;
            // }
        }
        echo $retorno;
        die();
    }

    public function getProducts($quantity1=false,$quantity2=false)
    {
        if ($quantity1) {
            $products = $this->model->getProdutos($quantity1,$quantity2);
        }else{
            $products = $this->model->getProdutos();
        }

        return $products;
    }

    public function mountDataFilter($products):array
    {
        $data = [];
        foreach ($products as $key=>$product) {
            $data['Categoria']['itens'][$product['categoria_nome']] = [
                'id'=>$product['categoria_id'],
                'rotulo'=>$product['categoria_nome'],
                'qtd' => isset($data['Categoria']['itens'][$product['categoria_nome']]) ? count($data['Categoria']['itens'][$product['categoria_nome']]) : 1
            ];

            $data['Estado']['itens'][$product['estado']] = [
                'id'=>$product['estado'],
                'rotulo'=>$product['estado'],
                'qtd' => isset($data['Estado']['itens'][$product['estado']]) ? count($data['Estado']['itens'][$product['estado']]) : 1
            ];
        }
        return $data;
    }

    public function getCacheFilter(Memcached $cache)
    {
        // $cache->deleteCache('products');
        // $cache->updateCacheAll();
        // $products = collect(json_decode($products,true));
        // echo json_decode($cache->getCache('filter'),true);
        echo $cache->getCache('filter');
        die();
    }

}
