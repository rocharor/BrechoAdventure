import Vue from 'vue'
import VMasker from 'vanilla-masker'
import Jcrop from 'jquery-jcrop'

var appVuePerfil = new Vue({
    el:'#el-form',
    data:{
        hide:{
            content:true,
            instrucao:true,
        },
        btnForm: true,
        divAlterPassword:false,
    },
    methods:{
        alterarFoto: function(){
            $('#select_image').trigger('click');
            this.hide.instrucao = false;
        },
        selecionarFoto: function(){
            // var $file = $(this)[0];
            var $file = $('#select_image')[0];
            this.alteraImagemPerfil($file);
        },
        alteraImagemPerfil: function($file){
            $("#select_image").next().html('');
            var reader = new FileReader;
            reader.onload = function() {
                var img = new Image;
                img.src = reader.result;
                img.onload = function() {
                    // if (img.width > 600 || img.height > 400) {
                    //     $("#select_image").next().html('Imagem tem dimensões maiores que o permitido.').removeClass('hide');
                    //     return false;
                    // }
                    // if ($file['files'][0]['size'] > 1000000) {
                    //     $("#select_image").next().html('Imagem ultrapassa o tamanho permitido.').removeClass('hide');
                    //     return false;
                    // }
                    // if ($file['files'][0]['type'] != 'image/png' && $file['files'][0]['type'] != 'image/jpeg') {
                    //     $("#select_image").next().html('Extensão da imagem não é permitida.').removeClass('hide');
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
        cancelarFoto: function(){
            $('.div_visualizacao').addClass('hide');
            $(".div_imagem").removeClass('hide');
        },
        openAlterPassword: function(){
            this.btnForm = false;
            this.divAlterPassword = true;
        },
        closeAlterPassword: function(){
            this.btnForm = true;
            this.divAlterPassword = false;
        }
    },
    created: function () {
        this.hide.content = false;
    }
})

// FUNÇÕES DIVERSAS
function checarSelecao(){
    if (parseInt($('#w').val())){
        return true
    }
    alertaPagina('Selecione a área para recorte.','danger');
    return false;
}

function buscaCEP(cep){
    var cep = cep.replace(/\D/g, '');
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
            $("input[name='endereco']").val(".....");
            $("input[name='bairro']").val(".....");
            $("input[name='cidade']").val(".....");

            $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    $("input[name='endereco']").val(dados.logradouro);
                    $("input[name='bairro']").val(dados.bairro);
                    $("input[name='cidade']").val(dados.localidade);
                    $("input[name='uf']").val(dados.uf);
                } else {
                    limpaEndereco();
                    alert("CEP não encontrado.");
                }
            });
        } else {
            limpaEndereco();
            alert("Formato de CEP inválido.");
        }
    } else {
        limpaEndereco();
    }
}

function limpaEndereco(){
    $("input[name='endereco']").val("");
    $("input[name='bairro']").val("");
    $("input[name='cidade']").val("");
    $("input[name='uf']").val("");
}

$(function () {
    if (document.getElementById("dt_nascimento") != null) {
        VMasker(document.getElementById("dt_nascimento")).maskPattern('99/99/9999');
    }
    if (document.getElementById("cep") != null) {
        VMasker(document.getElementById("cep")).maskPattern('99999-999');
    }
    if (document.getElementById("telefone_fixo") != null) {
        VMasker(document.getElementById("telefone_fixo")).maskPattern('(99) 9999-9999');
    }
    if (document.getElementById("telefone_cel") != null) {
        VMasker(document.getElementById("telefone_cel")).maskPattern('(99) 99999-9999');
    }
})
