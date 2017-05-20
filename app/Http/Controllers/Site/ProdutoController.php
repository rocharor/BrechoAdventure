<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Produto;
use App\Models\Site\Favorito;
use App\Models\Categoria;
use App\Services\Util;
// use App\Services\Cache;
// use Illuminate\Support\Facades\Mail;
use App\Mail\BrechoMail;
use App\Services\UploadImagem;
use App\Services\BreadCrumb;

class ProdutoController extends Controller
{
    use Util, UploadImagem, BreadCrumb;

    public $model;
    public $totalPagina = 8;

    public function __construct(Produto $produto)
    {
        $this->model = $produto;
    }

    public function index(Favorito $favorito)
    {
        $this->getBreadCrumb();
        $this->model->limit = $this->totalPagina;
        $produtos = $this->model->getProdutos(true);

        $favoritos = $favorito->getFavoritos();
        foreach($produtos as $produto){
            // $produto->idCodificado = base64_encode($produto->id);
            $produto->idCodificado = Util::cryptCustom($produto->id);
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

    // public function todosProdutos(Favorito $favorito, Request $request,$pg=1)
    public function produtos(Favorito $favorito, Request $request,$pg=1)
    {
        $this->getBreadCrumb();
        $limit = Util::geraLimitPaginacao($pg,$this->totalPagina);
        $this->model->limit = $limit['inicio'];
        $this->model->limitAux = $limit['fim'];
        $produtos = $this->model->getProdutos(true);

        $favoritos = $favorito->getFavoritos();
        foreach($produtos as $produto){
            // $produto->idCodificado = base64_encode($produto->id);
            $produto->idCodificado = Util::cryptCustom($produto->id);
            $arrImg = explode('|',$produto->nm_imagem);
            $produto->imgPrincipal = $arrImg[0];

            $produto->favorito = false;
            foreach($favoritos as $favorito){
                if($favorito->produto_id == $produto->id){
                    $produto->favorito = true;
                }
            }
        }

        $totalProdutos = count($this->model->getProdutos());
        $numberPages = (int)ceil($totalProdutos / $this->totalPagina);

        return view('site/todosProdutos',[
            'produtos'=>$produtos,
            'pg'=>$pg,
            'numberPages'=>$numberPages,
            'link'=>'/produto/todosProdutos/'
        ]);
    }

    public function meusProdutos($pg=1)
    {
        $this->getBreadCrumb();
        $limit = Util::geraLimitPaginacao($pg,$this->totalPagina);
        $this->model->limit = $limit['inicio'];
        $this->model->limitAux = $limit['fim'];
        $meusProdutos = $this->model->getMeusProdutos(true);

        foreach($meusProdutos as $produto){
            // $produto->idCodificado = base64_encode($produto->id);
            $produto->idCodificado = Util::cryptCustom($produto->id);
            $arrImg = explode('|',$produto->nm_imagem);
            $produto->imgPrincipal = $arrImg[0];
            $produto->dataExibicao = Util::formataDataExibicao($produto->created_at);
        }

        $totalProdutos = count($this->model->getMeusProdutos());
        $numberPages = (int)ceil($totalProdutos / $this->totalPagina);

        return view('minhaConta/produto',[
            'meusProdutos'=>$meusProdutos,
            'pg'=>$pg,
            'numberPages'=>$numberPages,
            'link'=>'/minha-conta/produto/'
        ]);
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
        // $foto_salva = false;
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

    // public function show($produto_id)
    public function show($hash_produto_id)
    {
        $this->getBreadCrumb();
        // $produto_id = base64_decode($produto_id);
        $produto_id = Util::decryptCustom($hash_produto_id);
        $produto = $this->model->getDescricaoProduto($produto_id);

        $imagens = [];
        if ($produto->nm_imagem != '') {
            $imagens = explode('|',$produto->nm_imagem);
        }

        $produto->imagens = $imagens;

        return view('site/visualizarProduto',['produto'=>$produto]);
    }

    public function edit($id, Categoria $categoria)
    {
        $produto_id = Util::decryptCustom($id);
        $produto = $this->model->find($produto_id);
        $produto->idCodificado = $id;
        $categorias = $categoria->all();

        $imagens = [];
        if ($produto->nm_imagem != '') {
            $imagens = explode('|',$produto->nm_imagem);
        }

        $produto->imagens = $imagens;
        $produto->dataExibicao = Util::formataDataExibicao($produto->created_at, false);

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

        $produto = $this->model->find(Util::decryptCustom($id));

        $produto->categoria_id = $request->get('categoria');
        $produto->titulo = $request->get('titulo');
        $produto->descricao = $request->get('descricao');
        $produto->valor = Util::formataMoedaBD($request->get('valor'));
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
            return redirect()->route('minha-conta.editar-produto',$id)->with('sucesso','Salvo com sucesso!');
        };

        return redirect()->route('minha-conta.editar-produto',$id)->with('erro','Erro ao salvar, tente novamente!');
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

    public function destroy($id)
    {
        $produto = $this->model->find($id);
        $retorno = 0;
        if (Auth::user()->id == $produto->user_id) {
            $retorno = $produto->delete();
        }
        echo $retorno;
        die();
    }

    // public function mountDataFilter()
    // {
    //     $data = [];
    //     $products = $this->model->getProdutos(true);
    //     foreach ($products as $key=>$product) {
    //         $data['Categoria']['itens'][$product['categoria']] = [
    //             'id'=>$product['categoria_id'],
    //             'rotulo'=>$product['categoria'],
    //             'qtd' => isset($data['Categoria']['itens'][$product['categoria']]) ? count($data['Categoria']['itens'][$product['categoria']]) : 1
    //         ];
    //
    //         $data['Estado']['itens'][$product['estado']] = [
    //             'id'=>$product['estado'],
    //             'rotulo'=>$product['estado'],
    //             'qtd' => isset($data['Estado']['itens'][$product['estado']]) ? count($data['Estado']['itens'][$product['estado']]) : 1
    //         ];
    //     }
    //     return $data;
    // }

    // public function getCacheFilter(Cache $cache)
    // {
    //     $cache->deleteCache('products');
    //     $cache->updateCacheAll();
    //     $products = collect(json_decode($products,true));
    //     echo json_decode($cache->getCache('filter'),true);
    //     echo $cache->getCache('filter');
    //     die();
    // }

    // public function show(Request $request)
    // {
    //     $produto_id = $request->get('produto_id');
    //     $produtos = $this->model->getDescricaoProduto($produto_id);
    //
    //     //echo response($produtos)->content();
    //     echo response()->json($produtos)->content();
    //     die();
    // }

}
