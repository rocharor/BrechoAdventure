<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Site\Produto;
use App\Models\Categoria;

class MyProductsController extends Controller
{
    private $model;

    public function __construct(Produto $produto)
    {
        $this->model = $produto;
    }

    public function index($pagina=1)
    {
        $this->model->paginacao = true;
        $this->model->pagina = $pagina;
        $meusProdutos = $this->model->getMeusProdutos();
        $numberPages = (int)ceil($meusProdutos['total'] / $this->model->totalPagina);

        foreach($meusProdutos['itens'] as $produto){
            $produto->imgPrincipal = $this->imagemPrincipal($produto->nm_imagem);
            $produto->dataExibicao = $this->formataDataExibicao($produto->updated_at);
        }

        return view('minhaConta/myProducts',[
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
            $this->model->user_id = Auth::user()->id;
            $this->model->categoria_id = $request->get('categoria');
            $this->model->titulo = $request->get('titulo');
            $this->model->slug = str_slug($request->get('titulo') . ' ' . time());
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

    public function inactivate($id)
    {
        $produto = $this->model->find($id);
        if (Auth::user()->id == $produto->user_id) {
            $produto->status = 0;
            if ($produto->save()) {
                return redirect()->route('minha-conta.meus-produto')->with('sucesso','Inativado com sucesso!');
            };

            return redirect()->route('minha-conta.meus-produto')->with('erro','Erro ao inativar, tente novamente!');
        }
    }

    public function delete($id)
    {
        $produto = $this->model->find($id);
        if (Auth::user()->id == $produto->user_id) {
            if ($produto->delete()) {
                return redirect()->route('minha-conta.meus-produto')->with('sucesso','Excluído com sucesso!');
            };
            return redirect()->route('minha-conta.meus-produto')->with('erro','Erro ao excluir, tente novamente!');
        }
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
}
