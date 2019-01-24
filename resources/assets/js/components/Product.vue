<template>
    <div class="box-product">
        <div class='box-favorite'>
            <div class='favorite' @click.prevent='setFavorite(favorite.parameter)'><span class='glyphicon glyphicon-star' :class="favorite.class" ></span></div>
        </div>

        <div class='box-title'>
            {{ dataProduct.titulo }}
        </div>

        <div class='box-image'>
            <img class="img-thumbnail" :src="imagem" alt="Produto">
        </div>

        <div class='box-value'>
            Pre&ccedil;o: R$ {{ dataProduct.valor }}
        </div>

        <div class='box-buttons'>
            <a :href="link" class='btn btn-warning'><b>Ver detalhes</b></a>
            <!-- <div> -->
                <modal-contact :product-id="dataProduct.id" :icon="true"/>
            <!-- </div> -->
        </div>
    </div>
</template>

<style media="screen">
    .box-product { text-align: center; margin-top: 20px;}
    .box-product .box-title { font-size: 18px; font-weight: bold; white-space: nowrap; width: 100%; overflow: hidden; text-overflow: ellipsis;}
    .box-product .box-image img { width: 100%; height: 100%; }
    .box-product .box-value { font-weight: bold }
    .box-product .box-favorite .favorite { width: 20px; height: 21px; display: block; margin: auto; cursor: pointer}
    .box-product .box-favorite .favorite .glyphicon { font-size: 24px}
    .box-product .box-favorite .favorite .active { color: #E8D336}
    .box-product .box-favorite .favorite .inactive { color: #ccc}
</style>

<script>
    import axios from 'axios';
    import ModalContact from './ModalContact.vue';
    import { alertaPagina } from '../site/global.js';

    export default {
        props: ['data-product', 'data-user'],
        name: 'catalogProducts',
        components: {
            ModalContact
        },
        data() {
            return {
                imagem: '/imagens/produtos/400x400/' + this.dataProduct.imgPrincipal,
                link: '/produtos/visualizar-produto/' + this.dataProduct.slug,
                favorite: {
                    class: '',
                    parameter: 0
                },
                buttonContact: {
                    title: '',
                    disabled: true,
                    parameter: 0,
                },
            }
        },
        methods: {
            setFavorite: function(produto_id) {
                if (produto_id == 0) {
                    alertaPagina('Necessário estar logado para favoritar.','danger');
                    return false;
                }

                axios.post('/minha-conta/favorito/storeFavorito', {
                    produto_id: produto_id
                })
                .then(retorno => {
                    if(retorno.data.success){
                        if (this.favorite.class == 'active') {
                            this.favorite.class = 'inactive'
                        } else {
                            this.favorite.class = 'active'
                        }
                    }else{
                        alertaPagina('Erro ao salvar favorito.','danger');
                    }
                })
                .catch(error => {
                    alertaPagina('Erro ao salvar favorito, tente novamente! [Cod=2]', 'danger');
                    console.log(error)
                })
            },
            verifyFavorite: function() {
                if (this.dataUser.logged) {
                    if (this.dataProduct.favorito) {
                        this.favorite.class = 'active'
                    } else {
                        this.favorite.class = 'inactive'
                    }
                    this.favorite.parameter = this.dataProduct.id
                } else {
                    this.favorite.class = 'inactive'
                    this.favorite.parameter = 0
                }
            }
        },
        created: function() {
            this.verifyFavorite();
        }
    }
</script>
