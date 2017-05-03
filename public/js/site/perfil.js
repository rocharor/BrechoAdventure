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
            // $("#foto_upd").on('change',function(e){
            //     e.preventDefault();
            //     var $file = $('#foto_upd')[0];
            //     self.altera_imagem($file);
            // })
            //
            // $('.alterar-foto').on('click',function(e){
            //     e.preventDefault();
            //     $('#foto_upd').trigger('click');
            // });

            $('.act-update').on('click',function(e){

                e.preventDefault();

                self.validaPerfil();
            });
        },
        mask: function(){
            VMasker(document.getElementById("dt_nascimento_upd")).maskPattern('99/99/9999');
            VMasker(document.getElementById("cep_upd")).maskPattern('99999-999');
            VMasker(document.getElementById("tel_upd")).maskPattern('(99) 9999-9999');
            VMasker(document.getElementById("cel_upd")).maskPattern('(99) 99999-9999');

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
        validaPerfil: function(){
            var nome = $('#nome_upd').val();
            var email = $('#email_upd').val();
            var dt_nascimento = $('#dt_nascimento_upd').val();
            var telefone_fixo = $('#tel_upd').val();
            var telefone_cel = $('#cel_upd').val();

            var erro = false;

            $('input').parent().removeClass('has-error');

            if(nome == ''){
                $('#nome_upd').parent().addClass('has-error');
                alertaPagina('Campo "nome" é obrigatório','danger');
                erro = true;
                return false;
            }

            if(email == ''){
                $('#email_upd').parent().addClass('has-error');
                alertaPagina('Campo "email" é obrigatório','danger');
                erro = true;
                return false;
            }

            if(dt_nascimento == ''){
                $('#dt_nascimento_upd').parent().addClass('has-error');
                alertaPagina('Campo "Data de nascimento" é obrigatório','danger');
                erro = true;
                return false;
            }

            if(telefone_fixo == '' && telefone_cel == ''){
                $('#tel_upd').parent().addClass('has-error');
                $('#cel_upd').parent().addClass('has-error');
                alertaPagina('Necessário pelo menos 1 número de telefone','danger');
                erro = true;
                return false;
            }

            $('#formPerfil').submit();
        },
        // altera_imagem: function($file){
        //     carregarMiniatura($file,'img_nova');
        //     $('.alterar-foto').addClass('hide');
        //     $('#btnEnviaFoto').removeClass('hide');
        //     $('#btnCancelarFoto').removeClass('hide');
        //     $('.img_nova').removeClass('hide');
        //
        //     $('.nm_imagem').append($file.files[0].name);
        // }

    };

    return Perfil;
})();

new PerfilClass().init();


function buscaCEP(cep){
    var cep = cep.replace(/\D/g, '');
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if(validacep.test(cep)) {
            $("#endereco_upd").val("...");
            $("#bairro_upd").val("...");
            $("#cidade_upd").val("...");
            $("#uf_upd").val("...");

            $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    $("#endereco_upd").val(dados.logradouro);
                    $("#bairro_upd").val(dados.bairro);
                    $("#cidade_upd").val(dados.localidade);
                    $("#uf_upd").val(dados.uf);
                }else {
                    limpaEndereco();
                    alert("CEP não encontrado.");
                }
            });
        }else {
            limpaEndereco();
            alert("Formato de CEP inválido.");
        }
    }else {
        limpaEndereco();
    }
}

function limpaEndereco(){
    $("#endereco_upd").val('');
    $("#bairro_upd").val('');
    $("#cidade_upd").val('');
    $("#uf_upd").val('');
}

$("#select_image").on('change',function(){

    // var $file = $("#select_image")[0];
    var $file = $(this)[0];
    if ($file.files && $file.files[0]) {
        var reader = new FileReader;
        reader.onload = function() {
            var img = new Image;
            img.onload = function() {
                if (img.width > 600 || img.height > 400) {
                    $(this).next().append('Imagem tem dimensões maiores que o permitido.')
                    return false;
                }
                if ($file['files'][0]['size'] > 1000000) {
                    $(this).next().append('Imagem ultrapassa o tamanho permitido.')
                    return false;
                }
                $('#visualizacao_imagem').attr('src', '');
                // $('#visualizacao_imagem').attr('src', reader.target.result);
                $('#visualizacao_imagem').attr('src', reader.result);
                $('.div_visualizacao').removeClass('hide');
                $(".div_imagem").addClass('hide');

                $('#visualizacao_imagem').Jcrop({
                    aspectRatio: 0,
                    onSelect: atualizaCoordenadas,
                    onChange: atualizaCoordenadas
                });

            }
            img.src = reader.result;
        }
        reader.readAsDataURL($file.files[0]);
    }
    // $('#visualizacao_imagem').attr('src', '');
    // var $file = $('#select_image')[0];
    // if ($file.files && $file.files[0]) {
    //     var reader = new FileReader();
    //
    //     reader.onload = function (e) {
    //         $('#visualizacao_imagem').attr('src', e.target.result);
    //         $('.div_visualizacao').removeClass('hide');
    //         $("#select_image").addClass('hide');
    //
    //         $('#visualizacao_imagem').Jcrop({
    //             aspectRatio: 0,
    //             onSelect: atualizaCoordenadas,
    //             onChange: atualizaCoordenadas
    //         });
    //     }
    //     reader.readAsDataURL($file.files[0]);
    // }
});

function atualizaCoordenadas(c){
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
}

function checkCoords(){
    if (parseInt($('#w').val()))
        return true;
    alert('Selecione a área para recorte.');
    return false;
}

$('#btnCancelarFoto').on('click',function(e){
    e.preventDefault();
    $('.div_visualizacao').addClass('hide');
    $(".div_imagem").removeClass('hide');
});
