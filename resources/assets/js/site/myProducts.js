import Breadcrumb from '../components/Breadcrumb.vue'
import MyProduct from '../components/MyProduct.vue'
import Pagination from '../components/Pagination.vue'

var elementMyProduct = document.getElementById("el-my-products")

if (elementMyProduct != null) {
   new Vue({
       el:'#el-my-products',
        components: {
            Breadcrumb,
            MyProduct,
            Pagination,
        },
        created:function () {
            elementMyProduct.classList.remove("hide")
        }
    });
}
