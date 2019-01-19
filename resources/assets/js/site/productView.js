var elementProduct = document.getElementById("el-view-products")

if (elementProduct != null) {
   new Vue({
        el:'#el-view-products',
        components: {
            'Breadcrumb': require('../components/Breadcrumb.vue'),
            'ProductZoom': require('../components/ProductZoom.vue'),
        },
        created:function () {
            elementProduct.classList.remove("hide")
        }
    });
}
