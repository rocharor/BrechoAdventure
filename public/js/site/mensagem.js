$(function(){
	$('.act-aba-msgMeusProdutos').click(function(){
		$('.act-aba-msgMeusProdutos').addClass('active');
		$('.act-aba-msgEnviadas').removeClass('active');

		$('.aba-msgMeusProdutos').removeClass('hide');
		$('.aba-msgEnviadas').addClass('hide');
	});

	$('.act-aba-msgEnviadas').click(function(){
		$('.act-aba-msgEnviadas').addClass('active');
		$('.act-aba-msgMeusProdutos').removeClass('active');

		$('.aba-msgEnviadas').removeClass('hide');
		$('.aba-msgMeusProdutos').addClass('hide');
	});

	$('.act-conversa').click(function(e){
	  e.preventDefault();
	  var status = $(this).attr('data-status');

	  if (status == 1) {
	    $(this).attr('data-status',0);
	    $(this).parent().next().removeClass('hide');
	  }else{

	    $(this).attr('data-status',1);
	    $('.act-conversa').parent().next().addClass('hide');
	  }




	})
})
