require('./bootstrap')

const { alertaPagina } = require('./site/global.js');
const notify = require('bootstrap-notify')
const xzoom = require('xzoom')
// const VMasker = require('vanilla-masker')
// const Jcrop = require('jquery-jcrop')

require('./site/produto')
require('./site/contato.js')
require('./site/productView.js')
require('./site/mensagem.js')
// require('./site/perfil.js')
// // require('./site/favorito.js')

window.onload =  function () {
    var msgSession = document.body.dataset.message
    if (msgSession != '') {
        msgSession = JSON.parse(msgSession);
        message = msgSession.message;
        type = msgSession.type;
        alertaPagina(message, type);
    }
}



// // Components
// Vue.component('example', require('./components/Example.vue'));
// Vue.component('Product', require('./components/Product.vue'));
// Vue.component('Breadcrumb', require('./components/Breadcrumb.vue'));
// Vue.component('product-zoom', require('./components/ProductZoom.vue'));
// Vue.component('my-product', require('./components/MyProduct.vue'));
// Vue.component('upload-crop-image', require('./components/UploadCropImage.vue'));


// const appMain = new Vue({
//     // el: '#appMain',
//     el: '#element-product',
//     created:function () {
//         var elemento = document.getElementById("appMain");
//         if (elemento != null) {
//             elemento.classList.remove("hide");
//         }
//     }
// });


// // Mascaras (cadastro e editar produto))
// if (document.getElementById("valor") != null) {
//     VMasker(document.getElementById("valor")).maskMoney();
// }

// if (document.getElementById("dt_nascimento") != null) {
//     VMasker(document.getElementById("dt_nascimento")).maskPattern('99/99/9999');
// }
// if (document.getElementById("cep") != null) {
//     VMasker(document.getElementById("cep")).maskPattern('99999-999');
// }
// if (document.getElementById("telefone_fixo") != null) {
//     VMasker(document.getElementById("telefone_fixo")).maskPattern('(99) 9999-9999');
// }
// if (document.getElementById("telefone_cel") != null) {
//     VMasker(document.getElementById("telefone_cel")).maskPattern('(99) 99999-9999');
// }
