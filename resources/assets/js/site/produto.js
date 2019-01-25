import Breadcrumb from '../components/Breadcrumb.vue'
import Product from '../components/Product.vue'

var elementProduct = document.getElementById("el-product")

if (elementProduct != null) {
   new Vue({
        el:'#el-product',
        components: {
            Product,
            Breadcrumb
        },
        created:function () {
            elementProduct.classList.remove("hide")
        }
    });
}
