import Vue from 'vue'

var appVueFavorito = new Vue({
    el:'#el-favorito',
    data:{},
    methods:{
        deleteFavorite: function(id){
            if(confirm('Deseja realmente excluir este item dos favoritos?')){
				window.open('/minha-conta/favorito/delete/' + id, '_self');
			}
        },
    },
    created: function(){
        var elemento = document.getElementById("el-favorito");
        if (elemento != null) {
            elemento.classList.remove("hide");
        }
    }
});
