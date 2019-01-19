var elementProduct = document.getElementById("el-product")

if (elementProduct != null) {
   new Vue({
        el:'#el-product',
        components: {
            'Product': require('../components/Product.vue'),
            'Breadcrumb': require('../components/Breadcrumb.vue'),
        },
        created:function () {
            elementProduct.classList.remove("hide")
        }
    });
}
