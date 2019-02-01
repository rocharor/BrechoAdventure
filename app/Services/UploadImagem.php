<?php

namespace App\Services;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

trait UploadImagem
{
    public $pathProfile = 'images/profile/';
    public $pathProduct = 'images/products/';
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
            $path = public_path($this->pathProfile . $fileName);
            $retorno = Image::make($file->getRealPath())->crop($this->w, $this->h, $this->x, $this->y)->save($path);

            if ($retorno) {
                return $fileName;
            }
        }
        return false;
    }

    public function deleteImagemPerfil($nomeImagem)
    {
        $filename = $this->pathProfile . $nomeImagem;
        return $this->deleteImagem($filename);
    }

    public function uploadImageProduct($file)
    {
        if ($this->validaExtImagem($file->extension())){
            $fileName  = time() . '_' . $file->hashName();

            $path = public_path($this->pathProduct . $fileName);

            $retorno = Image::make($file->getRealPath())->resize(400, 400)->save($path);

            if ($retorno) {
                return $fileName;
            }
        }
        return false;
    }

    public function deleteImagemProduto($nomeImagem)
    {
        $filename = $this->pathProduct . $nomeImagem;
        return $this->deleteImagem([$filename]);
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
