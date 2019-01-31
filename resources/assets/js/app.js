require('./bootstrap')

const { alertaPagina } = require('./site/global.js');

require('./site/produto')
require('./site/contato.js')
require('./site/productView.js')
require('./site/mensagem.js')
require('./site/profile.js')
// // require('./site/favorito.js')

// Flash Message
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
// Vue.component('my-product', require('./components/MyProduct.vue'));

// // Mascaras (cadastro e editar produto))
// if (document.getElementById("valor") != null) {
//     VMasker(document.getElementById("valor")).maskMoney();
// }


