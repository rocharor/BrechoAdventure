<?php

namespace App\Services;

use Illuminate\Http\Request;
use Image;
use File;

trait UploadImagem
{
    public $pathPerfil = 'imagens/cadastro/';
    public $pathProduto = 'imagens/produtos/200x200/';
    public $pathProdutoGG = 'imagens/produtos/900x900/';
    public $w = 0;
    public $h = 0;
    public $x = 0;
    public $y = 0;
    public $extencoesImagem = [
        'jpeg',
        'jpg',
        'png'
    ];

    public function imagemPerfil($file)
    {
        if ($this->validaExtImagem($file->extension())){
            $fileName  = time() . '_' . $file->hashName();
            $path = public_path($this->pathPerfil . $fileName);
            $retorno = Image::make($file->getRealPath())->crop($this->w, $this->h, $this->x, $this->y)->save($path);

            if ($retorno) {
                return $fileName;
            }
        }
        return false;
    }

    public function imagemProduto($file)
    {
        if ($this->validaExtImagem($file->extension())){
            $fileName  = time() . '_' . $file->hashName();

            $path = public_path($this->pathProduto . $fileName);
            $pathGG = public_path($this->pathProdutoGG . $fileName);

            // $this->recortar($file->getRealPath(),$path);
            // $this->recortar($file->getRealPath(),$pathGG);
            $retorno = Image::make($file->getRealPath())->resize(900, 900)->save($pathGG);
            $retornoGG = Image::make($file->getRealPath())->resize(200, 200)->save($path);

            if ($retorno && $retornoGG) {
                return $fileName;
            }
        }
        return false;
    }

    // private function recortar($pathOrigem, $pathDestino)
    // {
        // Image::make($pathOrigem)->resize(200, 200)->save($pathDestino);
    // }

    public function validaExtImagem($extensao){
        return  in_array(strtolower($extensao), $this->extencoesImagem);
    }

    public function deleteImagemProduto($nomeImagem)
    {
        $filename200 = $this->pathProduto . $nomeImagem;
        $filename900 = $this->pathProdutoGG . $nomeImagem;
        return $this->deleteImagem([$filename200, $filename900]);
    }

    public function deleteImagemPerfil($nomeImagem)
    {
        $filename = $this->pathPerfil . $nomeImagem;
        return $this->deleteImagem($filename);
    }

    private function deleteImagem($fileName)
    {
        if (is_array($fileName)) {
            foreach ($fileName as $file) {
                $retorno = File::delete($file);
            }
            return $retorno;
        }

        return File::delete($fileName);
    }

}
