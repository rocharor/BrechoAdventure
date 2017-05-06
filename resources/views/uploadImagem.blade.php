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

<form action="/minha-conta/perfil/updateFoto" method="post" enctype="multipart/form-data" onsubmit="return checarSelecao();">
    <div class="visible-xs">
        {{-- <form action='/minha-conta/perfil/updateFoto' name='formFotoPerfil' method='POST' enctype="multipart/form-data">
            {{ csrf_field() }}

            <div>
                <img src="/imagens/cadastro/{{ Auth::user()->nome_imagem }}" alt="brechoAdventure" class="img_perfil" />
                <img src="" alt="brechoAdventure" class="img_perfil img_nova hide" /><br>
            </div>
            <small><a class="alterar-foto">Alterar foto de perfil</a></small>
            <br>
            <button type='submit' id='btnEnviaFoto' class="btn btn-success hide">Salvar foto</button>&nbsp;&nbsp;
            <button id='btnCancelarFoto' class="btn btn-danger hide"><span class="glyphicon glyphicon-trash"></span></button>&nbsp;&nbsp;
            <b><small class='nm_imagem'></small></b>

            <input type="file" class="hide" id='foto_upd' name='imagemPerfil'>
        </form> --}}
    </div>
    <div class="hidden-xs">
        {{ csrf_field() }}
        <input type="hidden" id="x" name="x" />
        <input type="hidden" id="y" name="y" />
        <input type="hidden" id="w" name="w" />
        <input type="hidden" id="h" name="h" />

        <div class='div_imagem'>
            <img src="/imagens/cadastro/{{ Auth::user()->nome_imagem }}" alt="brechoAdventure" class="img_perfil" />
            <br />
            <small><a class="alterar-foto">Alterar foto de perfil</a></small>
            <br />
            <small class='text-danger instrucao hide'>Extenção permitida (jpg, png), dimenção permitida de até (600 x 400) e tamanho permitido de até 1Mb </small>
            <input type="file" id='select_image' name='imagemCrop' class='hide'>
            <br />
            <span class='text-danger'></span>
        </div>

        <div class="div_visualizacao hide">
            <p class='text-danger'>Selecione onde quer cortar a imagem</p>
            <div id="div_imagem">{{-- IMAGEM GRANDE --}}</div>
            <div class="preview">{{-- IMAGEM PREVIEW --}}</div>
            <br />
            <input type="submit" id="recortar" class='btn btn-success' value="Recortar Imagem" />
            <input type='button' id='btnCancelarFoto' class="btn btn-danger" value='Cancelar' />
        </div>

        {{--
        <div class="div_visualizacao hide">
            <p class='text-danger'>Selecione onde quer cortar a imagem</p>
            <div id="visualizacao_imagem"></div>
            <br />
            <input type="submit" id="recortar" class='btn btn-primary' value="Recortar Imagem" />
            <input type='button' id='btnCancelarFoto' class="btn btn-danger" value='Cancelar' />
        </div> --}}
    </div>
</form>
