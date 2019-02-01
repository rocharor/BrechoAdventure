import Breadcrumb from '../components/Breadcrumb.vue'
import Product from '../components/Product.vue'
import Pagination from '../components/Pagination.vue'

var elementProduct = document.getElementById("el-product")

if (elementProduct != null) {
   new Vue({
        el:'#el-product',
        components: {
            Breadcrumb,
            Product,
            Pagination,
        },
        created:function () {
            elementProduct.classList.remove("hide")
        }
    });
}
