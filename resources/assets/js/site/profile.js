import Breadcrumb from '../components/Breadcrumb.vue'
import UploadCropImage from '../components/UploadCropImage.vue'

var elementProfile = document.getElementById("el-profile")

if (elementProfile != null) {
    new Vue({
        el:'#el-profile',
        components: {
            Breadcrumb,
            UploadCropImage,
        },
        data:{
            hide:{
                content:true,
                instrucao:true,
            },
            btnForm: true,
            divAlterPassword:false,
        },
        methods:{
            openAlterPassword: function(){
                this.btnForm = false;
                this.divAlterPassword = true;
            },
            closeAlterPassword: function(){
                this.btnForm = true;
                this.divAlterPassword = false;
            },
            searchCep: function () {
                var cep = document.getElementById('cep').value
                var regexValidaCep = /^[0-9]{8}$/;
                cep = cep.replace(/\D/g, '');
                if (cep.length == 8 && regexValidaCep.test(cep)) {

                    // axios.get("http://viacep.com.br/ws/" + cep + "/json",
                    // {
                    //     headers: {
                    //         'Content-Type': 'application/json',
                    //         "Access-Control-Request-Headers": "*"
                    //     }
                    // })
                    // .then(response => {
                    //     console.log(response.data)
                    // }).catch(error => {
                    // })

                    $.getJSON("//viacep.com.br/ws/" + cep + "/json", function (data) {
                        if ("erro" in data) {
                            this.clearAddres()
                            alert("CEP não encontrado.");
                        } else {
                            document.getElementsByName('endereco')[0].value = data.logradouro
                            document.getElementsByName('bairro')[0].value = data.bairro
                            document.getElementsByName('cidade')[0].value = data.localidade
                            document.getElementsByName('uf')[0].value = data.uf
                        }
                    });
                } else {
                    this.clearAddres()
                    alert("CEP inválido.");
                }
            },
            clearAddres: function () {
                document.getElementsByName('endereco')[0].value = ''
                document.getElementsByName('numero')[0].value = ''
                document.getElementsByName('complemento')[0].value = ''
                document.getElementsByName('bairro')[0].value = ''
                document.getElementsByName('cidade')[0].value = ''
                document.getElementsByName('uf')[0].value = ''
            }
        },
        created: function () {
            elementProfile.classList.remove("hide")
        }
    })
}
