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
            $('#foto_upd').on('change',function(e){
                e.preventDefault();
                var $file = $('#foto_upd')[0];
                self.altera_imagem($file);
            })

            $('.act-alter-foto').on('click',function(e){
                e.preventDefault();
                $('#foto_upd').trigger('click');
            });

            $('#btnCancelarFoto').on('click',function(e){
                e.preventDefault();
                $('.act-alter-foto').removeClass('hide');
                $('#btnEnviaFoto').addClass('hide');
                $('#btnCancelarFoto').addClass('hide');
                $('.img_nova').addClass('hide');

                $('.nm_imagem').html('');
            });

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
        altera_imagem: function($file){
            carregarMiniatura($file,'img_nova');

            $('.act-alter-foto').addClass('hide');
            $('#btnEnviaFoto').removeClass('hide');
            $('#btnCancelarFoto').removeClass('hide');
            $('.img_nova').removeClass('hide');

            $('.nm_imagem').append($file.files[0].name);
        },
        validaPerfil: function(){
            console.log('aki')
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
        }

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
