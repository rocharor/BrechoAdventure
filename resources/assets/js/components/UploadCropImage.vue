<template>
    <div class='box-upload'>
        <link rel="stylesheet" href="/plugins/jquery-jcrop/css/jquery.Jcrop.min.css">

        <form action="/perfil/update-Foto" method="post" enctype="multipart/form-data" @submit.prevent="checkSelection">
            <input type="hidden" id="x" name="x">
            <input type="hidden" id="y" name="y">
            <input type="hidden" id="w" name="w">
            <input type="hidden" id="h" name="h">

            <div class='div_imagem'>
                <button type="button" class='btn btn-primary'  @click.prevent='alterImage()'> Alterar </button>
                <br>
                <input type="file" id='selectImage' name='imagemCrop' class='hide' @change.prevent='selectImage()'>
            </div>

            <!-- <div class="div_visualizacao" :class="hide: hidePreview"> -->
            <div class="div_visualizacao" :class="{hide: hidePreview}">
                <p><span class="label label-warning"><b class='text-danger'>Selecione onde quer cortar a imagem.</b></span></p>
                <!-- IMAGEM GRANDE -->
                <div id="div_imagem_alteracao"></div>

                <!-- IMAGEM PREVIEW -->
                <div class="preview"></div>
                <br>

                <input type='submit' class='btn btn-success' value='Recortar Imagem'>
                <input type='button' class='btn btn-danger' value='Cancelar' @click.prevent='cancelImage()'>
            </div>
            <span class='label label-warning instrucao' :class='{hide: hideInstruction}'><b class='text-danger'>Extenções permitidas ( jpg, png ), dimenção permitida de até (600 x 400) e tamanho permitido de até 1Mb </b></span>
        </form>
    </div>
</template>

<script>
    const { alertaPagina } = require('../site/global.js');

    export default {
        data() {
            return {
                hidePreview: 1,
                hideInstruction: 0,
            }
        },
        methods: {
            alterImage: function () {
                document.getElementById("selectImage").click()
            },
            checkSelection: function () {
                var value = document.getElementById("w").value
                if (parseInt(value) > 0){
                    return true
                }

                alertaPagina('Selecione a área para recorte.','danger');
                return false;
            },
            selectImage: function () {
                this.hidePreview = 0
                var $file = $('#selectImage')[0];
                this.alteraImagemPerfil($file);
            },
            alteraImagemPerfil: function($file){
                $("#selectImage").next().html('');
                var reader = new FileReader;
                reader.onload = function() {
                    var img = new Image;
                    img.src = reader.result;
                    img.onload = function() {
                        // if (img.width > 600 || img.height > 400) {
                        //     $("#selectImage").next().html('Imagem tem dimensões maiores que o permitido.').removeClass('hide');
                        //     return false;
                        // }
                        // if ($file['files'][0]['size'] > 1000000) {
                        //     $("#selectImage").next().html('Imagem ultrapassa o tamanho permitido.').removeClass('hide');
                        //     return false;
                        // }
                        // if ($file['files'][0]['type'] != 'image/png' && $file['files'][0]['type'] != 'image/jpeg') {
                        //     $("#selectImage").next().html('Extensão da imagem não é permitida.').removeClass('hide');
                        //     return false;
                        // }

                        var html = '<img src="'+reader.result+'" id="target" alt="Foto perfil" />'
                        $('#div_imagem_alteracao').html(html);
                        var html_preview = '<div id="preview-pane" class="hide"><div class="preview-container"><img src="'+reader.result+'" class="jcrop-preview" alt="Foto perfil Preview" /></div></div>'
                        $('.preview').html(html_preview);
                        $('.div_visualizacao').removeClass('hide');
                        $('.div_imagem').addClass('hide');

                        $('#x').val(0);
                        $('#y').val(0);
                        $('#w').val(img.width);
                        $('#h').val(img.height);

                        var jcrop_api,
                            boundx,
                            boundy,
                            $preview = $('#preview-pane'),
                            $pcnt = $('#preview-pane .preview-container'),
                            $pimg = $('#preview-pane .preview-container img'),
                            xsize = $pcnt.width(),
                            ysize = $pcnt.height();

                        $('#target').Jcrop({
                            onChange: updatePreview,
                            onSelect: updatePreview,
                            aspectRatio: 0,
                            bgOpacity: .2,
                            // setSelect: [ 0, 0, 0, 0 ],
                            // maxSize: [ 600, 400 ],
                            // minSize: [ 100, 100 ],
                            // bgFade:     true,
                            // bgColor:'#F0B207'
                        //   aspectRatio: xsize / ysize
                        },function(){
                            var bounds = this.getBounds();
                            boundx = bounds[0];
                            boundy = bounds[1];
                            jcrop_api = this;
                            $preview.appendTo(jcrop_api.ui.holder);
                        });

                        function updatePreview(c){
                            if (parseInt(c.w) > 0) {
                                var rx = xsize / c.w;
                                var ry = ysize / c.h;

                                $pimg.css({
                                    width: Math.round(rx * boundx) + 'px',
                                    height: Math.round(ry * boundy) + 'px',
                                    marginLeft: '-' + Math.round(rx * c.x) + 'px',
                                    marginTop: '-' + Math.round(ry * c.y) + 'px'
                                });

                                $('#preview-pane').removeClass('hide');
                            }
                            $('#x').val(c.x);
                            $('#y').val(c.y);
                            $('#w').val(c.w);
                            $('#h').val(c.h);
                        };
                    }
                }
                reader.readAsDataURL($file.files[0]);
            },
            cancelImage: function(){
                $('.div_visualizacao').addClass('hide');
                $(".div_imagem").removeClass('hide');
            },
        }
    };
</script>

<style>
    .img_perfil {
        max-height: 200px;
        min-height: 200px;
        max-width: 200px;
        min-width: 200px;
        border: solid 1px #ccc;
    }

    .jcrop-holder #preview-pane {
        display: block;
        position: absolute;
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

    .jcrop-holder .preview-container {
        width: 250px;
        height: 170px;
        overflow: hidden;
    }

</style>
