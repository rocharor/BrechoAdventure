if (document.getElementById("el-product") != null) {

   new Vue({
        el:'#el-product',
        components: {
            'Product': require('../components/Product.vue'),
            'Breadcrumb': require('../components/Breadcrumb.vue'),
        },
        created:function () {
            var elemento = document.getElementById("el-product");
            if (elemento != null) {
                elemento.classList.remove("hide");
            }
        }
    });
}
