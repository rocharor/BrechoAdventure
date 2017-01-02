$(function(){
	$('.act-aba-msgEnviadas').click(function(){
		$('.act-aba-msgEnviadas').addClass('active');
		$('.act-aba-msgMeusProdutos').removeClass('active');

		$('.aba-msgEnviadas').removeClass('hide');
		$('.aba-msgMeusProdutos').addClass('hide');
	});

	$('.act-aba-msgMeusProdutos').click(function(){
		$('.act-aba-msgMeusProdutos').addClass('active');
		$('.act-aba-msgEnviadas').removeClass('active');

		$('.aba-msgMeusProdutos').removeClass('hide');
		$('.aba-msgEnviadas').addClass('hide');
	});

	$('.act-conversa').click(function(e){
		e.preventDefault();
		var status = $(this).attr('data-status');

		if (status == 1) {
			$(this).attr('data-status',0);
			$(this).parent().next().removeClass('hide');
			var conversa_id = $(this).parent().next().attr('data-conversa-id');

			$.post(
				"/minha-conta/mensagem/update2",
				{conversa_id:conversa_id},
				function( data ) {
					buscaNotificacao();
				}
			)
		}else{
			$(this).attr('data-status',1);
			$('.act-conversa').parent().next().addClass('hide');
		}
	})

	$('.act-enviar-resposta').click(function(e){
		e.preventDefault();

		var conversa_id = $(this).parent().attr('data-conversa-id') ;
		var mensagem = $('#resposta_'+conversa_id).val();
		var tipo = $(this).attr('data-tipo');

		if (mensagem == '') {
			alertaPagina('Campo resposta não pode ser vazio','danger');
			return false;
		}
		$.ajax({
			url:'/minha-conta/mensagem/update',
			type:'POST',
			dataType:'json',
			data:{
				mensagem:mensagem,
				conversa_id:conversa_id
			},
			success: function(retorno){
				if(retorno){
					var data = retorno.data.date.split('.');
					var html = "<div class='conversa-esquerda'>";
					html += "<small><i>" + retorno.nome + " - " + data[0] + "</i></small>";
					html += "<p>" + retorno.mensagem + "</p></div>";
					$('.conversa_'+conversa_id).append(html);
					$('#resposta_'+conversa_id).val('');
				}else{
					alertaPagina('Erro ao enviar resposta 1','danger');
				}
			},
			error:function(retorno){
				alertaPagina('Erro ao enviar resposta 2','danger');
			}
		})


	})
})
