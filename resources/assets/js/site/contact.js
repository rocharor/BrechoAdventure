import Breadcrumb from '../components/Breadcrumb.vue'

var elementContact = document.getElementById("el-contact")

if (elementContact != null) {
    const { alertaPagina } = require('./global.js')

    new Vue({
        el:'#el-contact',
        components: {
            Breadcrumb
        },
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
                    alertaPagina('Preencha os campos corretamente', 'danger')
                    return false
                }
                this.imgLoader = true
                document.getElementById("myForm").submit()
            },
        },
        created: function(){
            elementContact.classList.remove("hide")
        }
    });
}
