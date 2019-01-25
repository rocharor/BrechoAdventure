import Breadcrumb from '../components/Breadcrumb.vue'

var elementMessage = document.getElementById("el-message");

if (elementMessage != null) {
    const { alertaPagina } = require('../site/global.js')

    new Vue({
        el: '#el-message',
        components: {
            Breadcrumb
        },
        data: {
            aba: {
                enviada: true,
                recebida: false
            }
        },
        methods: {
            // buscaDados: function(){
            //     var url = '';
            //     this.$http.post(url).then(function(response){

            //     });
            // },
            alteraAba: function(param){
                if (param == 1) {
                    this.aba.enviada = true;
                    this.aba.recebida = false;
                }else{
                    this.aba.recebida = true;
                    this.aba.enviada = false;
                }
            },
            openTalk: function(conversa_id){
                // alert(conversa_id)
                // var url = '/minha-conta/mensagem/updateNotificacao';
                // var data = {
                //     conversa_id:conversa_id
                // }
                // this.$http.post(url,data).then(function(response){
                //     // buscaNotificacao();
                // });

                $(".conversa").addClass('hide');

                var talk = document.getElementById("conversa_" + conversa_id);
                talk.classList.remove('hide');
            },
            closeTalk: function (conversa_id) {
                var talk = document.getElementById("conversa_" + conversa_id);
                talk.classList.add('hide');
            },
            excluiConversa: function(conversa_id){
                if (confirm('Deseja realmente apagar esta conversa?')){
                    var url = '/minha-conta/mensagem/delete';
                    var data = {
                        conversa_id:conversa_id
                    }

                    axios.post(url, data)
                    .then(function (response) {
                        if (response.status == 200) {
                            alertaPagina('Conversa excluida com sucesso.', 'success');
                        }

                        setTimeout(function () {
                            window.open('/minha-conta/mensagem', '_self');
                        }, 1500);
                    })
                    .catch(error => {
                        alertaPagina('Erro ao excluir conversa.', 'danger');
                        console.log(error)
                    })
                }
            }
        },
        created:function () {
            elementMessage.classList.remove("hide")
            // this.buscaDados();
        }
    })
}
