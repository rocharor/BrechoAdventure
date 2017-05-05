<?php

namespace App\Services;

use Illuminate\Http\Request;
use Auth;
use File;

trait Upload
{
// class Upload
    private $arquivo;
    private $h;
    private $w;
    private $x;
    private $y;
    private $destino;
    private $extencoes_imagem = [
        'jpeg',
        'jpg',
        'png'
    ];


    /**
     * Redimensiona imagem conforme parametros passados no "salvaCrop"
     * @param  [type] $extensao [Extensão do arquivo]
     * @return [type]           [Nome da nova imagem ou False]
     */
    private function redimensionar($extensao)
    {
        $novaImagem = imagecreatetruecolor($this->w, $this->h);
        $novoNome = Auth::user()->id . '-' . date('d-m-Y_h_i_s') . '.' . $extensao;
        $img_localizacao = $this->destino . $novoNome;
        $fotoSalva = false;

        switch ($extensao){
            case 'jpg':
            case 'jpeg':
                $origem = imagecreatefromjpeg($this->arquivo->path());
                imagecopyresampled($novaImagem, $origem, 0, 0, $this->x, $this->y,$this->w, $this->h, $this->w, $this->h);
                imagejpeg($novaImagem, $img_localizacao);
                break;
            case 'png':
                $origem = imagecreatefrompng($this->arquivo->path());
                imagecopyresampled($novaImagem, $origem, 0, 0, $this->x, $this->y,$this->w, $this->h, $this->w, $this->h);
                imagepng($novaImagem, $img_localizacao);
                break;
        }

        imagedestroy($novaImagem);
        imagedestroy($origem);

        if (File::exists($img_localizacao)) {
            return $novoNome;
        }
        return false;
    }

    private function validaExtImagem($extensao){
        return  in_array(strtolower($extensao), $this->extencoes_imagem);
    }

    /**
     * Recebe os parametros para redimensinoar a foto
     * @param  [type] $arquivo [Objeto UploadedFile Laravel]
     * @param  [type] $destino [Caminho do arquivo]
     * @param  [type] $h       [Altura do arquivo]
     * @param  [type] $w       [Largura do arquivo]
     * @param  [type] $x       [Posição x inicial]
     * @param  [type] $y       [Posição y inicial]
     * @return [type]          [Nome da nova imagem ou False]
     */
    public function salvarCrop($arquivo, $destino, $h, $w, $x, $y)
    {
        $this->arquivo = $arquivo;
        $this->destino = $destino;
        $this->h = $h;
        $this->w = $w;
        $this->x = $x;
        $this->y = $y;

        $extensao = $this->arquivo->extension();

        if ($this->validaExtImagem($extensao)) {
            $novoNome = $this->redimensionar($extensao);
            if ($novoNome){
                return $novoNome;
            }
        }
        return false;

    }

    public function salvarInteira($arquivo, $destino, $h, $w)
    {
    }

}
