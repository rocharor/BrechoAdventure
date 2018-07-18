/**
 * [Gera um alerta no topo da página]
 * @param  {[type]} texto  [Texto do alerta]
 * @param  {[type]} classe [Classe do alerta]
 */
var alertaPagina = function(texto,classe) {
	if(texto == 'undefined' || classe == 'undefined'){
		return false;
	}

	switch (classe) {
	case 'success':
		icone = 'glyphicon-warning-sign'
		break;
	case 'danger':
		icone = 'glyphicon-danger-sign'
		break;
	case 'warning':
		icone = 'glyphicon-warning-sign'
		break;
	default:
		icone = '';
		break;
	}

	$.notify({
        //icon: "glyphicon " + icone,
        message: texto,
    }, {
        element: 'body',
        type: classe,
        allow_dismiss: true,
        placement: {
            from: "top",
            align: "center"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 4000,
        timer: 1000,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        }
    });
}

/**
 * Carrega uma miniatuda dentro de um IMG
 * @param  {[type]} input  inputFile
 * @param  {[type]} modelo classe da IMG
 * @return {[type]} insere a imagem
 */
function carregarMiniatura(input,modelo) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.'+modelo).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

/**
 * [Pega a query string]
 * @return {[type]} [description]
 */
function getQueryString(){
	var query = location.search.slice(1);
	var partes = query.split('&');
	var data = {};

	partes.forEach(function (parte) {
		var chaveValor = parte.split('=');
		var chave = chaveValor[0];
		var valor = chaveValor[1];
		data[chave] = valor;
	});

	return data;
}

/**
 * [Busca notificações com intervalo de 5 minutos]
 * @return {[type]} [description]
 */
function buscaNotificacao(){
	// $.post(
	// 	"/minha-conta/mensagem/buscaNotificacao",
	// 	function( data ) {
	// 		if (data != '') {
	// 			$('.qtdMsg').html(data);
	// 			if (data > 0) {
	// 				var styles = {"font-weight":"bold","color":"red"};
	// 			}else{
	// 				var styles = {"font-weight":"normal","color":"black"};
	// 			}
	// 			$('.qtdMsg').css(styles);
	// 		}
	// 	}
	// );
	// setTimeout(function(){
	// 	buscaNotificacao();
	// },300000);
}

module.exports = {
  alertaPagina
}
