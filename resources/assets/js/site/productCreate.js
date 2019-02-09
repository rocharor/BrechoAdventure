import VMasker from 'vanilla-masker'
import Breadcrumb from '../components/Breadcrumb.vue'

var elCreateProduct = document.getElementById("el-create-product")

if (elCreateProduct != null) {
    new Vue({
        el: '#el-create-product',
        components: {
            Breadcrumb,
        },
        methods: {
            applyMask: function () {
                VMasker(document.getElementById("valor")).maskMoney();
            }
        },
        created: function () {
            elCreateProduct.classList.remove("hide")
        },
        mounted: function () {
            this.applyMask()
        }
    });
}
