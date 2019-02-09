import Breadcrumb from '../components/Breadcrumb.vue'
import Pagination from '../components/Pagination.vue'
import ModalContact from '../components/ModalContact.vue'

var elFavorite = document.getElementById("el-my-favorites")

if (elFavorite != null) {
    new Vue({
        el: '#el-my-favorites',
        components: {
            Breadcrumb,
            Pagination,
            ModalContact,
        },
        methods: {
            deleteFavorite: function (id) {
                if (confirm('Deseja realmente excluir este item dos favoritos?')) {
                    window.open('/minha-conta/favorito/delete/' + id, '_self');
                }
            },
        },
        created: function () {
            elFavorite.classList.remove("hide")
        }
    });
}
