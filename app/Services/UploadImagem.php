<?php

namespace App\Services;

use Illuminate\Http\Request;
use Image;
use File;

trait UploadImagem
{
    public $pathPerfil = 'imagens/cadastro/';
    public $pathProduto = 'imagens/produtos/400x400/';
    public $pathProdutoGG = 'imagens/produtos/600x600/';
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

    public function deleteImagemPerfil($nomeImagem)
    {
        $filename = $this->pathPerfil . $nomeImagem;
        return $this->deleteImagem($filename);
    }

    public function imagemProduto($file)
    {
        if ($this->validaExtImagem($file->extension())){
            $fileName  = time() . '_' . $file->hashName();

            $path = public_path($this->pathProduto . $fileName);
            $pathGG = public_path($this->pathProdutoGG . $fileName);

            $retorno = Image::make($file->getRealPath())->resize(400, 400)->save($path);
            $retornoGG = Image::make($file->getRealPath())->resize(600, 600)->save($pathGG);

            if ($retorno && $retornoGG) {
                return $fileName;
            }
        }
        return false;
    }

    public function deleteImagemProduto($nomeImagem)
    {
        $filename400 = $this->pathProduto . $nomeImagem;
        $filename600 = $this->pathProdutoGG . $nomeImagem;
        return $this->deleteImagem([$filename400, $filename600]);
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

    public function validaExtImagem($extensao){
        return  in_array(strtolower($extensao), $this->extencoesImagem);
    }

}
