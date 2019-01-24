<template>
    <div class='box-contact'>
        <button class='btn btn-info' :title='buttonContact.title' :disabled="buttonContact.disabled == true" @click.prevent="openContact(productId)">
            <span class="glyphicon glyphicon-envelope"></span>
            <span v-if="icon == false">Enviar mensagem</span>
        </button>

        <div class="modal fade" :class="'modal-mensagem-' + productId">
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

<script>
    import axios from 'axios';
    import { alertaPagina } from '../site/global.js';

    export default {
        props: ['product-id', 'icon'],
        name: 'modalContact',
        data() {
            return {
                buttonContact: {
                    title: '',
                    disabled: true
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
                .then(response => {
                    if (response.status != 200) {
                        throw 'Error';
                    }
                    response = response.data
                    this.dataContact.remetente = response.nome_remet;
                    this.dataContact.destinatario = response.name;
                    this.dataContact.titulo = response.titulo;
                    this.dataContact.produto_id = produto_id;

                    $('.modal-mensagem-' + this.productId).modal();
                })
                .catch(error => {
                    alertaPagina('Erro ao buscar dados.','danger');
                    console.log(error)
                })
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
                .then(response => {
                    if (response.status == 201) {
                        alertaPagina('Mensagem enviada com sucesso.','success');
                    }else{
                        alertaPagina('Erro ao enviar mensagem, tente novamente! [Cod=1]','danger');
                    }

                    $('.modal-mensagem-' + this.productId).modal('hide');
                })
                .catch(error => {
                    alertaPagina('Erro ao enviar mensagem, tente novamente! [Cod=2]', 'danger');
                    console.log(error)
                })
            },
            // verifyContact: function() {
            //     if (this.auth == 1) {
            //         this.buttonContact.disabled = false
            //     }
            // }
        },
        created: function() {
            // this.verifyContact();
        }
    };
</script>

<style>
    .box-contact {display: inline-block;}
    .box-contact .modal {text-align: left;}
</style>
