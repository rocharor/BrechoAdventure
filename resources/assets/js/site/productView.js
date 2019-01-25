import Breadcrumb from '../components/Breadcrumb.vue'
import ProductZoom from '../components/ProductZoom.vue'
import ModalContact from '../components/ModalContact.vue'

var elementProduct = document.getElementById("el-view-products")

if (elementProduct != null) {
   new Vue({
        el:'#el-view-products',
        components: {
            Breadcrumb,
            ProductZoom,
            ModalContact,
        },
        created:function () {
            elementProduct.classList.remove("hide")
        }
    });
}
