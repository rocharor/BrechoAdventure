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

            <button class='btn btn-info' :title='buttonContact.title' :disabled="buttonContact.disabled == true" @click.prevent="openContact(buttonContact.parameter)"><span class="glyphicon glyphicon-envelope"></span></button>
        </div>

        <!-- Modal de contato -->
        <div class="modal fade" :class="'modal-mensagem-' + dataProduct.id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <input type="hidden" name="produto_id" value="">

                    <div class="modal-header" >
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body" >
                        <h2>{{ dataContact.titulo }}</h2>

                        <p><label>De: &nbsp;</label><span> {{ dataContact.remetente }} </span></p>
                        <p><label>Para: &nbsp;</label><span> {{ dataContact.destinatario }} </span></p>
                        <p><label>Mensagem: &nbsp;</label><textarea class='form-control' name="mensagem" rows="8" cols="50" required="required" id='campo-mensagem' v-model='dataContact.mensagem'></textarea></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class='btn btn-danger' name="button" data-dismiss="modal">Cancelar</button>
                        <button type="button" class='btn btn-success act-enviar-mensagem' name="button" @click.prevent="sendContact()">Enviar</button>
                    </div>

                </div>
            </div>
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
    .box-product .modal {text-align: left;}
</style>

<script>
    import axios from 'axios';
    const { alertaPagina } = require('../site/global.js');

    export default {
        props: ['data-product', 'data-user'],
        name: 'catalogProducts',
        data() {
            return {
                imagem: '/imagens/produtos/200x200/' + this.dataProduct.imgPrincipal,
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
                dataContact: {
                    remetente: '',
                    destinatario: '',
                    titulo: '',
                    produto_id: 0,
                    mensagem: ''
                },
            }
        },
        methods: {
            openContact: function(produto_id) {
                this.dataContact.mensagem = '';

                axios.post('/minha-conta/mensagem/create', {
                    produto_id: produto_id
                })
                .then(retorno => {
                    retorno = retorno.data
                    this.dataContact.remetente = retorno.nome_remet;
                    this.dataContact.destinatario = retorno.name;
                    this.dataContact.titulo = retorno.titulo;
                    this.dataContact.produto_id = produto_id;
                })
                .catch(error => {
                    alertaPagina('Erro ao buscar dados.','danger');
                    console.log(error)
                })

    		    $('.modal-mensagem-' + this.dataProduct.id).modal();
            },
            sendContact: function() {
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

                    $('.modal-mensagem-' + this.dataProduct.id).modal('hide');
                })
                .catch(error => {
                    alertaPagina('Erro ao enviar mensagem, tente novamente! [Cod=2]', 'danger');
                    console.log(error)
                })
            },
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
            },
            verifyContact: function() {
                if (this.dataUser.logged) {
                    if (this.dataUser.id == this.dataProduct.user_id) {
                        this.buttonContact.title = 'Este produto é seu';
                        this.buttonContact.disabled = true;
                        this.buttonContact.parameter = 0;
                    } else {
                        this.buttonContact.title = '';
                        this.buttonContact.disabled = false;
                        this.buttonContact.parameter = this.dataProduct.id;
                    }

                } else {
                    this.buttonContact.title = 'Necessário estar logado';
                }
            }

        },
        created: function() {
            this.verifyFavorite();
            this.verifyContact();
        }
    }
</script>
