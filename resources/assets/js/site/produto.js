import Vue from 'vue'
import axios from 'axios'
import VMasker from 'vanilla-masker'
import notify from 'bootstrap-notify'
import bootstrap from 'bootstrap'

import Example from '../components/Example.vue'
Vue.component('example', Example);

import Product from '../components/Product.vue'
Vue.component('Product', Product);

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
    },
    methods:{
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
