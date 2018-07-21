require('./bootstrap')

import notify from 'bootstrap-notify'
import VMasker from 'vanilla-masker'
// import xzoom from 'xzoom'
const xzoom = require('xzoom')
/*** DISPONIVEIS PARA IMPORT ***/
// import jquery-jcrop from 'jquery-jcrop'

require('./site/produto')
// require('./site/favorito.js')
// require('./site/perfil.js')

Vue.component('example', './components/Example.vue');
Vue.component('Product', require('./components/Product.vue'));
Vue.component('Breadcrumb', require('./components/Breadcrumb.vue'));
Vue.component('product-zoom', './components/ProductZoom.vue');
Vue.component('my-product', require('./components/MyProduct.vue'));

const appMain = new Vue({
    el: '#appMain',
    created:function () {
        var elemento = document.getElementById("appMain");
        if (elemento != null) {
            elemento.classList.remove("hide");
        }
    }
});
