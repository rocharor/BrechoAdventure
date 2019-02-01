require('./bootstrap')

const { alertaPagina } = require('./site/global.js');

require('./site/contact.js')
require('./site/productView.js')
require('./site/message.js')
require('./site/profile.js')
require('./site/products')
require('./site/myProducts.js')
require('./site/createProduct.js')
require('./site/editProduct.js')
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
