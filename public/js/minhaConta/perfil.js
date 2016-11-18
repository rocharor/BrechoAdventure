$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
/*=======================
AÇÕES PARA ALTERAR FOTO
=======================*/

/**
* acão para quando clica no link alterar foto;
*/
$('.act-alter-foto').click(function(e){
    e.preventDefault();

   $('#foto_upd').trigger('click');
});

/**
* executa quando escolhe a imagem;
*
*/
var altera_imagem = function(){

    var nm_imagem = $('#foto_upd')[0].files[0].name;

    $('.act-alter-foto').addClass('hide');
    $('.act-enviar-imagem').removeClass('hide');
    $('#btnEnviaFoto').removeClass('hide');

    $('.nm_imagem').append(nm_imagem);
}

/**
* Faz o update da imagem
*/
$('.act-enviar-imagem').click(function(e){
    e.preventDefault();

    var $foto = $('#foto_upd')[0].files[0];
    var form_data = new FormData();
    form_data.append('arquivo',$foto);
    $.ajax({
        url: '/minha-conta/perfil/updateFoto',
        type: 'post',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: form_data,
        success: function(retorno){
            if(retorno.sucesso == true){
                alert(retorno.mensagem);
                window.location.reload();
            }else{
                alert(retorno.mensagem);
                $('.act-alter-foto').removeClass('hide');
                $('.act-enviar-imagem').addClass('hide');
                $('.nm_imagem').html('');
            }

        },
        error: function(retorno){

        }
    })
})


/**
* Salva dados do formulario
*/
$('.act-update').click(function(e){
    e.preventDefault()

    var nome = $('#nome_upd').val();
    var apelido = $('#apelido_upd').val();
    var email = $('#email_upd').val();
    var dt_nascimento = $('#dt_nascimento_upd').val();
    var endereco = $('#endereco_upd').val();
    var numero = $('#numero_upd').val();
    var complemento = $('#complemento_upd').val();
    var bairro = $('#bairro_upd').val();
    var cidade = $('#cidade_upd').val();
    var uf = $('#uf_upd').val();
    var cep = empty($('#cep_upd').val()) ? 0 : $('#cep_upd').val();
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

   if(!erro){
   var dados = {  'name':nome,
                  'apelido':apelido,
                  'email':email,
                  'dt_nascimento':dt_nascimento,
                  'endereco':endereco,
                  'numero':numero,
                  'complemento':complemento,
                  'bairro':bairro,
                  'cidade':cidade,
                  'uf':uf,
                  'cep':cep,
                  'telefone_fixo':telefone_fixo,
                  'telefone_cel':telefone_cel
              };

        $.ajax({
            url:'/minha-conta/perfil/updatePerfil',
            dataType: 'json',
            type: 'POST',
            data: {'dados': dados},
            success: function(retorno){
               if(retorno){
                  alertaPagina('Dados salvos com sucesso','success');
               }else{
                  alertaPagina('Erro ao salvar!','warning');
               }
            },
            error: function(retorno){
               alertaPagina('Erro no sistema! cod-G1','danger');
            }
        });
    }
});

/**
* Faz autocomplete do endereço
*/
function buscaCEP(cep){

   cep = cep.replace('-','');
   console.log(cep);

}
// Mascaras
(function() {
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
})();
