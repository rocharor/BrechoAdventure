// Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

var appVueMsg = new Vue({
    el: '#el-mensagem',
    data: {
        aba: {
            enviada: true,
            recebida: false
        }
    },
    methods: {
        buscaDados: function(){
            var url = '';
            this.$http.post(url).then(function(response){

            });
        },
        alteraAba: function(param){
            if (param == 1) {
                this.aba.enviada = true;
                this.aba.recebida = false;
            }else{
                this.aba.recebida = true;
                this.aba.enviada = false;
            }
        },
        abreConversa: function(conversa_id){
            var url = '/minha-conta/mensagem/updateNotificacao';
            var data = {
                conversa_id:conversa_id
            }
            this.$http.post(url,data).then(function(response){
                // buscaNotificacao();
            });

            $(".conversa").addClass('hide');
            $("#conversa_" + conversa_id).removeClass('hide');
        },
        excluiConversa: function(conversa_id){
            if (confirm('Deseja realmente apagar esta conversa?')){
                var url = '/minha-conta/mensagem/delete';
                var data = {
                    conversa_id:conversa_id
                }
                this.$http.post(url,data).then(function(response){
                    if (response.body) {
                        alertaPagina('Conversa excluida com sucesso.','success');
                            setTimeout(function(){
                                window.open('/minha-conta/mensagem','_self');
                            }, 2000);
                    }else{
                        alertaPagina('Erro ao excluir conversa! [cod:1]','danger');
                    }
                });
                // $.ajax({
                //     url:'/minha-conta/mensagem/delete',
                //     method:'POST',
                //     data:{
                //         conversa_id:conversa_id
                //     },
                //     success:function(retorno){
                //         if (retorno) {
                //             alertaPagina('Conversa excluida com sucesso.','success');
                //             setTimeout(function(){
                //                 window.open('/minha-conta/mensagem','_self');
                //             }, 2000);
                //         }else{
                //             alertaPagina('Erro ao excluir conversa! [cod:1]','danger');
                //         }
                //     },
                //     error:function(){
                //         alertaPagina('Erro ao excluir conversa! [cod:2]','danger');
                //     }
                // })
            }
        },
        enviarResposta: function(conversa_id,mensagem,tipo){
            // if (mensagem == '') {
			// 	alertaPagina('Campo resposta não pode ser vazio','danger');
			// 	return false;
			// }
			// $.ajax({
			// 	url:'/minha-conta/mensagem/update',
			// 	type:'POST',
			// 	dataType:'json',
			// 	data:{
			// 		mensagem:mensagem,
			// 		conversa_id:conversa_id
			// 	},
			// 	success: function(retorno){
			// 		if(retorno){
			// 			var data = retorno.data.date.split('.');
			// 			var html = "<div class='conversa-esquerda'>";
			// 			html += "<small><i>" + retorno.nome + " - " + data[0] + "</i></small>";
			// 			html += "<p>" + retorno.mensagem + "</p></div>";
			// 			$('.conversa_'+conversa_id).append(html);
			// 			$('#resposta_'+conversa_id).val('');
			// 		}else{
			// 			alertaPagina('Erro ao enviar resposta 1','danger');
			// 		}
			// 	},
			// 	error:function(retorno){
			// 		alertaPagina('Erro ao enviar resposta 2','danger');
			// 	}
			// })
        }

    },
    created:function () {
        $('.el-mensagem').removeClass('hide');
        // this.buscaDados();
    }
})
