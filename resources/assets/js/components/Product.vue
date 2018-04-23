<template>
    <div class="box-product">
        <div class='box-favorite'>
            <div class='favorite' @click.prevent='setFavorite(0)' v-if="dataUser.logged == 0"><span class='glyphicon glyphicon-star inactive'></span></div>
            <div class='favorite' @click.prevent='setFavorite(1)' v-else-if="dataUser.logged == 1 && verifyFavorite(dataProduct.id)"><span class='glyphicon glyphicon-star active'></span></div>
            <div class='favorite' @click.prevent='setFavorite(2)' v-else><span class='glyphicon glyphicon-star inactive'></span></div>
        </div>

        <div class='box-title'>
            {{ dataProduct.titulo }}
        </div>

        <div class='box-image'>
            <img class="img-thumbnail" :src="dataProduct.imagem" alt="Produto">
        </div>

        <div class='box-value'>
            Pre&ccedil;o: R$ {{ dataProduct.valor }}
        </div>

        <div class='box-buttons'>
            <a :href="'XX/XX/' + dataProduct.id" class='btn btn-warning'><b>Ver detalhes</b></a>
            <button class='btn btn-info' title='Necessário estar logado' disabled v-if="dataUser.logged == 0"><span class="glyphicon glyphicon-envelope"></span></button>
            <button class='btn btn-info' title='Este produto é seu' disabled v-else-if="dataUser.user_id == dataProduct.user_id"><span class="glyphicon glyphicon-envelope"></span></button>
            <button class='btn btn-info' @click.prevent="openContact(dataProduct.id)" v-else ><span class="glyphicon glyphicon-envelope"></span></button>
        </div>
    </div>
</template>

<style media="screen">
    .box-product { text-align: center; }
    .box-product .box-title { font-size: 18px; font-weight: bold;}
    .box-product .box-image { width: 200px; height: 200px; margin: 0 auto;}
    .box-product .box-image img { width: 100%; height: 100%; }
    .box-product .box-value { font-weight: bold }
    .box-product .box-favorite .favorite { width: 20px; height: 21px; display: block; margin: auto; cursor: pointer}
    .box-product .box-favorite .favorite .glyphicon { font-size: 24px}
    .box-product .box-favorite .favorite .active { color: #E8D336}
    .box-product .box-favorite .favorite .inactive { color: #ccc}
</style>

<script>
    export default {
        props: ['data-product', 'data-user'],
        data() {
            return {

            }
        },
        methods: {
            openContact: function(id) {
                alert(id)
            },
            verifyFavorite: function(product_id) {
                var inArray = this.dataUser.favorites.indexOf(product_id) + 1;
                if (inArray > 0) {
                    return true
                }
                return false
            },
            setFavorite: function(status) {
                if (status == 0) {
                    alert('Necessário estar logado')
                } else if (status == 1) {
                    alert('Ação Desfavoritado')
                } else {
                    alert('Ação Favoritado')
                }
            },
        },
        created: function() {

        }
    }

</script>
