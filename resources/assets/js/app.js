require('./bootstrap');

window.Vue = require('vue');

/*** DISPONIVEIS PARA IMPORT ***/
// import Vue from 'vue'
// import axios from 'axios'
// import bootstrap from 'bootstrap'
// import notify from 'bootstrap-notify'
// import VMasker from 'vanilla-masker'
// import xzoom from 'xzoom'
// import jquery-jcrop from 'jquery-jcrop'

require('./site/produto')
require('./site/visualizarProduto.js')
require('./site/favorito.js')
require('./site/perfil.js')

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
