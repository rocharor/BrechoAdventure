<template>
    <div class="box-my-product">
        <p v-if="product.status == 0"><span class="label label-danger">Produto inativo</span></p>
        <p v-else-if="product.status == 1"><span class="label label-success">Ativo <b>{{ product.dataExibicao }}</b></span></p>
        <p v-else-if="product.status == 2"><span class="label label-info"><b>Aguardando aprovação</b></span></p>
        <p v-else-if="product.status == 3"><span class="label label-warning"><b>Altera&ccedil;&atilde;o reprovada</b></span></p>

        <div class="titulo"><b>{{ product.titulo }}</b></div>

        <!-- Produto inativado -->
        <div v-if="product.status == 0">
            <div class='div_imagem'>
                <img :src="image" style="filter: contrast(5%);">
            </div>
            <br>
            <div class='btn_acoes'>
                <div>
                    <a :href="linkEdit" class="btn btn-primary">Republicar</a>
                </div>
                <div>
                    <button class="btn btn-danger" title='Excluir definitivamente' @click.prevent="deleteProduct(product.id)">
                        <span class='glyphicon glyphicon-remove'></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Produto pendente -->
        <div v-else-if="product.status == 2">
            <div class='div_imagem'>
                <img :src="image" style="filter: grayscale(100%)">
            </div>
            <br>
            <div class='btn_acoes'>
                <div>
                    <a :href="linkEdit" class="btn btn-primary" title='Editar produto'>
                        <span class='glyphicon glyphicon-pencil'></span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Produto reprovado -->
        <div v-else-if="product.status == 3">
            <div class='div_imagem'>
                <img :src="image" style="filter: grayscale(100%)">
            </div>
            <br>
            <div class='btn_acoes'>
                <div>
                    <a :href="linkEdit" class="btn btn-primary" title='Editar produto'>
                        <span class='glyphicon glyphicon-pencil'></span>
                    </a>
                </div>
                <div>
                    <button class="btn btn-danger" title='Inativar produto' @click.prevent="inactiveProduct(product.id)">
                        <span class='glyphicon glyphicon-trash'></span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Produto ativo -->
        <div v-else>
            <div class='div_imagem'>
                <img :src="image">
            </div>
            <br>
            <div class='btn_acoes'>
                <div>
                    <a :href="linkEdit" class="btn btn-primary" title='Editar produto'>
                        <span class='glyphicon glyphicon-pencil'></span>
                    </a>
                </div>
                <div>
                    <a :href="linkView" class="btn btn-success" title='Visualizar produto'>
                        <span class='glyphicon glyphicon-eye-open'></span>
                    </a>
                </div>
                <div>
                    <button class="btn btn-danger" title='Inativar produto' @click.prevent="inactiveProduct(product.id)">
                        <span class='glyphicon glyphicon-trash'></span>
                    </button>
                </div>
                <!-- <div><button class="btn  btn-warning favorito"><div class="favorito-ativo"></div> - {{ $produto->qtd_favorito }}</button></div> -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['product'],
        data() {
            return {
                image: '/images/products/' + this.product.imgPrincipal,
                linkEdit: '/minha-conta/produto/editar-produto/' + this.product.slug,
                linkView: '/produtos/visualizar-produto/' + this.product.slug,
            }
        },
        methods: {
            deleteProduct:function(id){
                if (confirm('Deseja realmente excluir definitivamente este produto?')) {
                    window.open('/minha-conta/produto/delete/' + id, '_self');
                }
            },
            inactiveProduct:function(id){
                if (confirm('Deseja realmente inativar este produto?')) {
                    window.open('/minha-conta/produto/inativar/' + id, '_self');
                }
            },
        },
        created: function() {

        },
    }
</script>

<style media="screen">

</style>
