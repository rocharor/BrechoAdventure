$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });

var PerfilClass = (function() {

    function Perfil() {
    }

    Perfil.prototype = {
        init: function() {
          this.actions();
          this.mask();
        },

        actions: function() {
			var self = this;

            $('.alterar-foto').on('click',function(e){
                e.preventDefault();
                $('#select_image').trigger('click');
                $('.instrucao').removeClass('hide');
            });

            $("#select_image").on('change',function(e){
                e.preventDefault();
                var $file = $(this)[0];
                self.altera_imagem_perfil($file);
            });

            $('#btnCancelarFoto').on('click',function(e){
                e.preventDefault();
                $('.div_visualizacao').addClass('hide');
                $(".div_imagem").removeClass('hide');
            });

            $('.act-update').on('click',function(e){
                e.preventDefault();
                self.validaPerfil();
            });
        },

        mask: function(){
            VMasker(document.getElementById("dt_nascimento")).maskPattern('99/99/9999');
            VMasker(document.getElementById("cep")).maskPattern('99999-999');
            VMasker(document.getElementById("telefone_fixo")).maskPattern('(99) 9999-9999');
            VMasker(document.getElementById("telefone_cel")).maskPattern('(99) 99999-9999');

         	// #maskMoney
         	// VMasker(document.getElementById("default")).maskMoney();
         	// VMasker(document.getElementById("defaultValues")).maskMoney();
         	// VMasker(document.getElementById("zeroCents")).maskMoney({zeroCents: true});
         	// VMasker(document.getElementById("unit")).maskMoney({unit: 'R$'});
         	// VMasker(document.getElementById("suffixUnit")).maskMoney({suffixUnit: 'R$'});
         	// VMasker(document.getElementById("delimiter")).maskMoney({delimiter: ','});
            // VMasker(document.getElementById("separator")).maskMoney({separator: '.'});

         	// #maskNumber
         	// VMasker(document.getElementById("numbers")).maskNumber();

         	// #maskPattern
         	// VMasker(document.getElementById("phone")).maskPattern('(99) 9999-9999');
         	// VMasker(document.getElementById("phoneValues")).maskPattern('(99) 9999-9999');
         	// VMasker(document.getElementById("date")).maskPattern('99/99/9999');
         	// VMasker(document.getElementById("doc")).maskPattern('999.999.999-99');
         	// VMasker(document.getElementById("carPlate")).maskPattern('AAA-9999');
         	// VMasker(document.getElementById("vin")).maskPattern('SS.SS.SSSSS.S.S.SSSSSS');
        },

        altera_imagem_perfil: function($file){
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

        }

        // validaPerfil: function(){
        //     var nome = $('#nome_upd').val();
        //     var email = $('#email_upd').val();
        //     var dt_nascimento = $('#dt_nascimento_upd').val();
        //     var telefone_fixo = $('#tel_upd').val();
        //     var telefone_cel = $('#cel_upd').val();
        //
        //     var erro = false;
        //
        //     $('input').parent().removeClass('has-error');
        //
        //     if(nome == ''){
        //         $('#nome_upd').parent().addClass('has-error');
        //         alertaPagina('Campo "nome" é obrigatório','danger');
        //         erro = true;
        //         return false;
        //     }
        //
        //     if(email == ''){
        //         $('#email_upd').parent().addClass('has-error');
        //         alertaPagina('Campo "email" é obrigatório','danger');
        //         erro = true;
        //         return false;
        //     }
        //
        //     if(dt_nascimento == ''){
        //         $('#dt_nascimento_upd').parent().addClass('has-error');
        //         alertaPagina('Campo "Data de nascimento" é obrigatório','danger');
        //         erro = true;
        //         return false;
        //     }
        //
        //     if(telefone_fixo == '' && telefone_cel == ''){
        //         $('#tel_upd').parent().addClass('has-error');
        //         $('#cel_upd').parent().addClass('has-error');
        //         alertaPagina('Necessário pelo menos 1 número de telefone','danger');
        //         erro = true;
        //         return false;
        //     }
        //
        //     $('#formPerfil').submit();
        // },
    };

    return Perfil;
})();

new PerfilClass().init();

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
