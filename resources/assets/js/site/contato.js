import Vue from 'vue'

var appVueContato = new Vue({
    el:'#el-contato',
    data: {
        teste: '12345',
        dataContact: {
            name: 'aa',
            email: '',
            category: '',
            message: '',
        },
        imgLoader: false,
    },
    methods:{
        onSubmit: function(){
            alert('aki')
        },
    },
    created: function(){
        var elemento = document.getElementById("el-contato");
        if (elemento != null) {
            elemento.classList.remove("hide");
        }
    }
});
