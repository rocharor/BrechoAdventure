if (document.getElementById("el-contact") != null) {
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
                    alert('Preencha os campos corretamente')
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
            var elemento = document.getElementById("el-contact");
            if (elemento != null) {
                elemento.classList.remove("hide");
            }
        }
    });
}
