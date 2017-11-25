<!--
dependencies
jquery.Jcrop.css
jquery.Jcrop.js
perfil.js
 -->
<style type="text/css">
    .jcrop-holder #preview-pane {
        display: block;
        position: absolute;
        /*z-index: 2000;*/
        /*top: 10px;*/
        right: -280px;
        padding: 6px;
        border: 1px rgba(0,0,0,.4) solid;
        background-color: white;

        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;

        -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
        box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
    }

    #preview-pane .preview-container {
        width: 250px;
        height: 170px;
        overflow: hidden;
    }

</style>

<div class="div_alterar_foto">
    <form action="{{ Route('minha-conta.update-foto') }}" method="post" enctype="multipart/form-data" onsubmit="return checarSelecao();">
        {{ csrf_field() }}
        <input type="hidden" id="x" name="x">
        <input type="hidden" id="y" name="y">
        <input type="hidden" id="w" name="w">
        <input type="hidden" id="h" name="h">

        <div class='div_imagem'>
            <img src="/imagens/cadastro/{{ Auth::user()->nome_imagem }}" alt="brechoAdventure" class="img_perfil">
            <br />
            <small><a @click.prevent='alterarFoto()'>Alterar foto de perfil</a></small>
            <br />
            <input type="file" id='select_image' name='imagemCrop' class='hide' @change.prevent='selecionarFoto()'>
            <span class="label label-danger hide"></span>
        </div>

        <div class="div_visualizacao hide">
            <p><span class="label label-warning"><b class='text-danger'>Selecione onde quer cortar a imagem.</b></span></p>
            <div id="div_imagem_alteracao">{{-- IMAGEM GRANDE --}}</div>
            <div class="preview">{{-- IMAGEM PREVIEW --}}</div>
            <br />
            <input type='submit' class='btn btn-success' value='Recortar Imagem'>
            <input type='button' class='btn btn-danger' value='Cancelar' @click.prevent='cancelarFoto()'>
        </div>
        <span class='label label-warning instrucao' :class='{hide: hide.instrucao == true}'><b class='text-danger'>Extenções permitidas ( jpg, png ), dimenção permitida de até (600 x 400) e tamanho permitido de até 1Mb </b></span>
    </form>
</div>
