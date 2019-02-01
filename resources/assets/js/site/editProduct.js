import VMasker from 'vanilla-masker'
import Breadcrumb from '../components/Breadcrumb.vue'

var elEditProduct = document.getElementById("el-edit-product")

if (elEditProduct != null) {
    new Vue({
        el: '#el-edit-product',
        components: {
            Breadcrumb,
        },
        methods: {
            applyMask: function () {
                VMasker(document.getElementById("valor")).maskMoney();
            }
        },
        created: function () {
            elEditProduct.classList.remove("hide")
        },
        mounted: function () {
            this.applyMask()
        }
    });
}
