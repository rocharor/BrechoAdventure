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

    var nome = empty($('#nome_upd').val()) ? null : $('#nome_upd').val();
    var apelido = empty($('#apelido_upd').val()) ? null : $('#apelido_upd').val();
    var email = empty($('#email_upd').val()) ? null : $('#email_upd').val();
    var dt_nascimento = empty($('#dt_nascimento_upd').val()) ? null : $('#dt_nascimento_upd').val();
    var endereco = empty($('#endereco_upd').val()) ? null : $('#endereco_upd').val();
    var numero = empty($('#numero_upd').val()) ? null : $('#numero_upd').val();
    var complemento = empty($('#complemento_upd').val()) ? null : $('#complemento_upd').val();
    var bairro = empty($('#bairro_upd').val()) ? null : $('#bairro_upd').val();
    var cidade = empty($('#cidade_upd').val()) ? null : $('#cidade_upd').val();
    var uf = empty($('#uf_upd').val()) ? null : $('#uf_upd').val();
    var cep = empty($('#cep_upd').val()) ? 0 : $('#cep_upd').val();
    var tel_fixo = empty($('#tel_upd').val()) ? null : $('#tel_upd').val();
    var tel_cel = empty($('#cel_upd').val()) ? null : $('#cel_upd').val();

    var erro = false;

    if(nome == ''){
        $('#nome_upd').parent().addClass('has-error');
        alert('Campo nome é obrigatório');
        erro = true;
        return false;
    }

    if(email == ''){
        $('#email_upd').parent().addClass('has-error');
        alert('Campo email é obrigatório');
        erro = true;
        return false;
    }

    if(dt_nascimento == ''){
        $('#dt_nascimento_upd').parent().addClass('has-error');
        alert('Campo "Data de nascimento" é obrigatório');
        erro = true;
        return false;
    }

    if(tel_fixo == '' && tel_cel == ''){
        $('#tel_upd').parent().addClass('has-error');
        $('#cel_upd').parent().addClass('has-error');
        alert('Necessário pelo menos 1 número de telefone');
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
                  'telefone_fixo':tel_fixo,
                  'telefone_cel':tel_cel
              };

        $.ajax({
            url:'/minha-conta/perfil/updatePerfil',
            dataType: 'json',
            type: 'POST',
            data: {'dados': dados},
            success: function(retorno){
                if(retorno){
                    alert('Dados salvos com sucesso');
                }
                else{
                    alert('Erro ao salvar!')
                }
            },
            error: function(retorno){
                alert('Erro no sistema! cod-G1')
            }
        });
    }
});

/**
 * Método JS que verifica se var esta vazia
 * @param  {[type]} mixedVar [description]
 * @return {[type]}          [description]
 */
function empty (mixedVar) {
    var undef
    var key
    var i
    var len
    var emptyValues = [undef, null, false, 0, '', '0']

    for (i = 0, len = emptyValues.length; i < len; i++) {
        if (mixedVar === emptyValues[i]) {
            return true
        }
    }

    if (typeof mixedVar === 'object') {
        for (key in mixedVar) {
            if (mixedVar.hasOwnProperty(key)) {
            return false
            }
        }
        return true
    }

    return false
}
