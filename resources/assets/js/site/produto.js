import Vue from 'vue'
import axios from 'axios'
import VMasker from 'vanilla-masker'
import notify from 'bootstrap-notify'

// import InputSearch from '../components/InputSearch.vue'

// new Vue({
//     el: '.teste',
//     components: {
//         InputSearch,
//     }
// });

var appProdutosSite = new Vue({
    el:'#el-produtos',
    data:{
        dataDescription:{
            titulo:'',
            descricao:'',
            estado:'',
            valor:'',
            name:'',
            email:'',
            fixo:'',
            cel:''
        },
        dataContact:{
            remetente:'',
            destinatario:'',
            titulo:'',
            produto_id:0,
            mensagem:''
        }

    },
    methods:{
        setFavorite:function(produto_id){
            if (produto_id == 0) {
                alertaPagina('Necessário estar logado para favoritar.','danger');
                return false;
            }

            axios.post('/minha-conta/favorito/storeFavorito', {
                produto_id: produto_id
            })
            .then(retorno => {
                if(retorno.data.success){
                    var elemento = document.getElementsByClassName('star-' + produto_id)[0];
                    if (elemento.className.indexOf('inactive') !== -1) {
                        elemento.classList.remove("inactive")
                        elemento.classList.add("active")
                    } else {
                        elemento.classList.remove("active")
                        elemento.classList.add("inactive")
                    }
                }else{
                    alertaPagina('Erro ao salvar favorito.','danger');
                }
            })
            .catch(error => {
                console.log(error)
            })
        },
        openContact:function(produto_id){
            this.dataContact.mensagem = '';

            axios.post('/minha-conta/mensagem/create', {
                produto_id: produto_id
            })
            .then(retorno => {
                retorno = retorno.data
                appProdutosSite.dataContact.remetente = retorno.nome_remet;
                appProdutosSite.dataContact.destinatario = retorno.name;
                appProdutosSite.dataContact.titulo = retorno.titulo;
                appProdutosSite.dataContact.produto_id = produto_id;
            })
            .catch(error => {
                alertaPagina('Erro ao buscar dados.','danger');
                console.log(error)
            })

		    $('#modal-mensagem').modal();
        },
        sendContact:function(){
            if (this.dataContact.mensagem == '') {
                alertaPagina('Campo mensagem não pode ser vazio','danger');
                return false;
            }

            axios.post('/minha-conta/mensagem/store', {
                produto_id: this.dataContact.produto_id,
                mensagem: this.dataContact.mensagem
            })
            .then(retorno => {
                if (retorno.data.success == 1) {
                    alertaPagina('Mensagem enviada com sucesso.','success');
                }else{
                    alertaPagina('Erro ao enviar mensagem, tente novamente! [Cod=1]','danger');
                }

                $('#modal-mensagem').modal('hide');
            })
            .catch(error => {
                alertaPagina('Erro ao enviar mensagem, tente novamente! [Cod=2]', 'danger');
                console.log(error)
            })
        }
    },
    created:function () {
        var elemento = document.getElementById("el-produtos");
        if (elemento != null) {
            elemento.classList.remove("hide");
        }
    }
});

var appProdutosMinhaConta = new Vue({
    el:'#el-produtos-minha-conta',
    data:{},
    methods:{
        inactiveProduct:function(id){
            if (confirm('Deseja realmente inativar este produto?')) {
                window.open('/minha-conta/produto/inativar/' + id, '_self');
            }
        },
        deleteProduct:function(id){
            if (confirm('Deseja realmente excluir definitivamente este produto?')) {
                window.open('/minha-conta/produto/delete/' + id, '_self');
            }
        },
        deletePhoto:function(nm_photo, product_id){
            if (confirm('Deseja realmente excluir esta foto?')) {

                axios.post('/minha-conta/produto/delete-foto', {
                    nm_foto: nm_photo,
                    produto_id: product_id
                })
                .then(retorno => {
                    if (retorno.data.sucesso = true) {
                        window.location.reload();
                    } else {
                        alertaPagina(retorno.data.msg, 'danger');
                    }
                })
                .catch(error => {
                    alertaPagina('Erro no sistema!', 'danger');;
                    console.log(error)
                })
            }
        },
    },
    created:function () {
        var elemento = document.getElementById("el-produtos-minha-conta");
        if (elemento != null) {
            elemento.classList.remove("hide");
        }
    }
});

// Mascaras
(function() {
    if (document.getElementById("valor") != null) {
        VMasker(document.getElementById("valor")).maskMoney();
    }
})();