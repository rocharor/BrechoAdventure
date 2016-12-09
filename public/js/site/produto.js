$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.act-descricao').click(function(e){
    e.preventDefault();

    var produto_id = $(this).data('id');

    $.ajax({
        url: '/produto/descricao-produto',
        dataType: 'json',
        type: 'POST',
        data: {'produto_id': produto_id},
        success: function(retorno){
            if(retorno){
    			var fotos = retorno.nm_imagem.split('|');
    			$('.produto_fotos').html('');
    			$('.indicadores').html('');
    			for(var i in fotos){
    				if(i == 0){
    					$('.produto_fotos').append("<div class='item active '><img src=/imagens/produtos/" + fotos[i] + " alt='' style='width:100%; height:400px'></div>")
    					$('.indicadores').append("<li data-target='#carousel-example-generic' data-slide-to='" + i + "' class='active'></li>")
    				}else{
    					$('.produto_fotos').append("<div class='item'><img src=/imagens/produtos/" + fotos[i] + " alt='' style='width:100%; height:400px'></div>")
    					$('.indicadores').append("<li data-target='#carousel-example-generic' data-slide-to='" + i + "' class=''></li>")
    				}
    			}


            	$('.produto_titulo').html(retorno.titulo)
                $('.produto_descricao').html(retorno.descricao)
                $('.produto_estado').html(retorno.estado)
                $('.produto_valor').html('R$ ' + retorno.valor)

                $('.produto_nome').html(retorno.name)
                $('.produto_email').html(retorno.email)
                $('.produto_telefone').html(retorno.fixo + " / " + retorno.cel)

                $('#modal_descricao').modal();
            }else{
                alert('Erro ao buscar descrição do produto.')
            }

        },
        error: function(retorno){
            alert('Erro no sistema! cod-02')
        }
    })
});

// $('.abre-descricao').click(function(e){
	// e.preventDefault();
	// $('#modal_descricao').modal();
// });

$('.act-excluir-produto').click(function(e) {

    var produto_id = $(this).attr('data-produto-id');

    if (confirm('Deseja realmente excluir este produto?')) {
        $.ajax({
            url : '/minha-conta/meus-produtos/deletarProduto/',
            type : 'POST',
            dataType : 'json',
            data : {
                'produto_id' : produto_id
            },
            success : function(retorno) {
                if (retorno.sucesso == true) {
                    alert(retorno.msg);
                    window.location.reload();
                } else {
                    alert(retorno.mensagem);
                }
            },
            error : function() {
                alert('Erro no sistema! cod-G1');
            }
        })
    }
});

$('.act-excluir-foto').click(function() {

    if (confirm('Deseja realmente excluir esta foto?')) {
        var produto_id = $('.act-excluir-foto').attr('data-produto-id');
        var nm_foto = $(this).attr('data-foto');
        $.ajax({
            url :'/minha-conta/meus-produtos/deletarFoto/',
            type : 'POST',
            dataType : 'json',
            data : {
                'nm_foto' : nm_foto,
                'produto_id' : produto_id
            },
            success : function(retorno) {
                if (retorno.sucesso = true) {
                    window.open('/minha-conta/meus-produtos/meusProdutosEditar/produto/'+produto_id,'_self');
                } else {
                    alert(retorno.msg);
                }
            },
            error : function() {
                alert('Erro no sistema!');
            }
        });
    }
});

$('.act-alterar-produto').click(function(e) {
    e.preventDefault();

    var produto_id = $(this).attr('data-produto-id');
    var titulo = $('#titulo_produto_update').val();
    var categoria = $('#categoria_produto_update').val();
    var descricao = $('#desc_produto_update').val();
    var estado = $("input[name='tipo_produto_update']:checked").val()
    var valor = $('#valor_produto_update').val();

    var $form = $('[name=formEditarProduto]');

    if (titulo == '') {
        $('#titulo_produto_update').parent().addClass('has-error');
        alert('Campo titulo é obrigatório');
        return false;
    }
    if (categoria == '') {
        $('#categoria_produto_update').parent().addClass('has-error');
        alert('Campo categoria é obrigatório');
        return false;
    }
    if (descricao == '') {
        $('#desc_produto_update').parent().addClass('has-error');
        alert('Campo descricao é obrigatório');
        return false;
    }
    if (estado == '') {
        $("input[name='tipo_produto_update']").parent().addClass('has-error');
        alert('Campo estado é obrigatório');
        return false;
    }
    if (valor == '') {
        $('#valor_produto_update').parent().addClass('has-error');
        alert('Campo valor é obrigatório');
        return false;
    }

    $form.submit();
});

// $("#valor_produto_update").maskMoney({
//     prefix : 'R$ ',
//     thousands : '.',
//     decimal : ','
// });
