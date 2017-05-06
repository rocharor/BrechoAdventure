<?php

namespace App\Services;

use Illuminate\Http\Request;

trait Util
{
    public static function validaServidor()
    {
        // error_reporting(E_ALL);
        // ini_set('display_errors', 0);
        $producao = 1;
        if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1:8001' || $_SERVER['HTTP_HOST'] == 'localhost:8000') {
            // ini_set('display_errors', 1);
            $producao = 0;
        }

        return $producao;
    }

    // public static function validaExtImagem($ext)
    // {
    //     $extencoes = array(
    //         'jpg',
    //         'jpeg',
    //         'png'
    //     );
    //
    //     if(in_array($ext,$extencoes)){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }

    public static function escapeSql($value)
    {
        $search = array(
            "\\",
            "\x00",
            "\n",
            "\r",
            "'",
            '"',
            "\x1a"
        );
        $replace = array(
            "\\\\",
            "\\0",
            "\\n",
            "\\r",
            "\'",
            '\"',
            "\\Z"
        );
        return str_replace($search, $replace, $value);
    }

    public static function removeAcentos($string)
    {
        $string = preg_replace(array(
            "/(á|à|ã|â|ä)/",
            "/(Á|À|Ã|Â|Ä)/",
            "/(é|è|ê|ë)/",
            "/(É|È|Ê|Ë)/",
            "/(í|ì|î|ï)/",
            "/(Í|Ì|Î|Ï)/",
            "/(ó|ò|õ|ô|ö)/",
            "/(Ó|Ò|Õ|Ô|Ö)/",
            "/(ú|ù|û|ü)/",
            "/(Ú|Ù|Û|Ü)/",
            "/(ñ)/",
            "/(Ñ)/",
            "/(ç)/",
            "/(Ç)/"
        ), explode(" ", "a A e E i I o O u U n N c C"), $string);

        return $string;
    }

    /**
     * Verifica se a url existe
     *
     * @param
     *            $url
     * @return bool
     */
    public static function url_exists($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($code == 200);
    }

    /**
     * Tranforma imagem e base64
     *
     * @param unknown $f
     * @return string
     */
    public static function base64Image($f)
    {
        $image = file_get_contents($f);
        $encrypted = base64_encode($image);
        $url = "data:image/jpg;base64," . $encrypted;
        return $url;
    }

    public static function geraCSV($filename, $emails)
    {
        // desabilitar cache
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // forçar download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposição do texto / codificação
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");

        echo self::array_para_csv($emails);
        die();
    }

    public function array_para_csv(array &$array)
    {
        if (count($array) == 0) {
            return null;
        }

        ob_start();
        $df = fopen("php://output", 'w');
        // usados para criar key
        // fputcsv($df, array_keys(reset($array)));
        foreach ($array as $row) {
            fputcsv($df, $row, ";");
        }
        fclose($df);

        return ob_get_clean();
    }

    /**
     * Gero os LIMIT para inserir na query
     *
     * @param unknown $pg
     * @param unknown $total_pagina
     * @return string|unknown
     */
    public static function geraLimitPaginacao($pg, $total_pagina)
    {
        if ($pg == 1) {
            $limit['inicio'] = $total_pagina;
            $limit['fim'] = 0;
        } else {
            $limit_inicio = $total_pagina;
            $limit_fim = ($pg - 1) * ($total_pagina);
            $limit['inicio'] = $limit_inicio;
            $limit['fim'] = $limit_fim;
        }

        return $limit;
    }

    public function validaStringInt($valor)
    {
        if(is_numeric($valor)){
            $retorno = filter_var ($valor,FILTER_VALIDATE_INT);
            if(!$retorno){
                $retorno = filter_var ($valor,FILTER_VALIDATE_FLOAT);
            }
        }elseif(is_bool($valor)){
            $retorno = filter_var ($valor,FILTER_VALIDATE_BOOLEAN);
        }elseif(is_string($valor)){
            $retorno = filter_var ($valor,FILTER_SANITIZE_STRING);
            $retorno = trim($retorno);
        }else{
            $retorno = null;
        }

        return $retorno;

    }

    public static function formataMoedaBD($valor)
    {
        $valor = preg_replace("/[^0-9]/", "", $valor);
        $valor = (int)$valor;
        $valor = preg_replace("/([0-9]{2})$/", "$2.$1", $valor);

        return $valor;
    }

    public static function formataDataExibicao($data)
    {
        return date("d/m/Y H:m:s",strtotime($data));;
    }

    public static function formataDataBD($data,$hora=true)
    {
        $arrDataHora = explode(' ',$data);
        $arrData = explode('/',$arrDataHora[0]);
        $arrDataHora[0] = implode('-',array_reverse($arrData));
        $data = implode(' ',$arrDataHora);
        if (!$hora) {
            return date("Y-m-d",strtotime($data));;
        }

        return date("Y-m-d H:m:s",strtotime($data));;
    }

}
