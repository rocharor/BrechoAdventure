require('./bootstrap')

const { alertaPagina } = require('./site/global.js');

require('./site/contact.js')
require('./site/message.js')
require('./site/profile.js')
require('./site/products')
require('./site/productView.js')
require('./site/myProducts.js')
require('./site/productCreate.js')
require('./site/productEdit.js')
require('./site/favorite.js')

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
