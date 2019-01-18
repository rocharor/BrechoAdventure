var elementoContact = document.getElementById("el-contact");

if (elementoContact != null) {

    const { alertaPagina } = require('../site/global.js');

    new Vue({
        el:'#el-contact',
        data: {
            dataContact: {
                name: '',
                email: '',
                category: '',
                message: '',
            },
            imgLoader: false,
        },
        methods:{
            onSubmit: function(){
                if (this.dataContact.name == '' || this.dataContact.email == '' || this.dataContact.category == '' || this.dataContact.message == '') {
                    alertaPagina('Preencha os campos corretamente', 'danger');
                    return false
                }
                this.imgLoader = true;
                document.getElementById("myForm").submit();
            },
        },
        components: {
            'Breadcrumb': require('../components/Breadcrumb.vue'),
        },
        created: function(){
            elementoContact.classList.remove("hide");
        }
    });
}
