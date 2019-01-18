var elementoProduct = document.getElementById("el-product");

if (elementoProduct != null) {
   new Vue({
        el:'#el-product',
        components: {
            'Product': require('../components/Product.vue'),
            'Breadcrumb': require('../components/Breadcrumb.vue'),
        },
        created:function () {
            elementoProduct.classList.remove("hide");
        }
    });
}
