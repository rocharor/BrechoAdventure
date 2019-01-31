import VMasker from 'vanilla-masker'
import Breadcrumb from '../components/Breadcrumb.vue'
import UploadCropImage from '../components/UploadCropImage.vue'
import { alertaPagina } from './global.js';

var elementProfile = document.getElementById("el-profile")

if (elementProfile != null) {
    new Vue({
        el: '#el-profile',
        components: {
            Breadcrumb,
            UploadCropImage,
        },
        data: {
            btnForm: true,
            divAlterPassword: false,
        },
        methods: {
            openAlterPassword: function () {
                this.btnForm = false;
                this.divAlterPassword = true;
            },
            closeAlterPassword: function () {
                this.btnForm = true;
                this.divAlterPassword = false;
            },
            searchCep: function () {
                var cep = document.getElementById('cep').value
                var regexValidaCep = /^[0-9]{8}$/
                cep = cep.replace(/\D/g, '')

                if (cep.length == 8 && regexValidaCep.test(cep)) {
                    delete window.axios.defaults.headers.common['X-CSRF-TOKEN']

                    axios.get("https://viacep.com.br/ws/" + cep + "/json")
                        .then(response => {
                            if ("erro" in response.data) {
                                this.clearAddres()
                                alertaPagina("CEP não encontrado.", 'warning')
                            } else {
                                document.getElementsByName('endereco')[0].value = response.data.logradouro
                                document.getElementsByName('bairro')[0].value = response.data.bairro
                                document.getElementsByName('cidade')[0].value = response.data.localidade
                                document.getElementsByName('uf')[0].value = response.data.uf
                            }
                        }).catch(error => {
                            this.clearAddres()
                            alertaPagina("Erro ao buscar CEP.", 'danger')
                            console.log(error)
                        })
                } else {
                    this.clearAddres()
                    alertaPagina("CEP inválido.", 'warning')
                    document.getElementById('cep').focus()
                }
            },
            clearAddres: function () {
                document.getElementsByName('endereco')[0].value = ''
                document.getElementsByName('numero')[0].value = ''
                document.getElementsByName('complemento')[0].value = ''
                document.getElementsByName('bairro')[0].value = ''
                document.getElementsByName('cidade')[0].value = ''
                document.getElementsByName('uf')[0].value = ''
            },
            applyMask: function () {
                VMasker(document.getElementById("cep")).maskPattern('99999-999')
                VMasker(document.getElementById("dt_nascimento")).maskPattern('99/99/9999')
                VMasker(document.getElementById("telefone_fixo")).maskPattern('(99) 9999-9999')
                VMasker(document.getElementById("telefone_cel")).maskPattern('(99) 99999-9999')
            },
            validate: function () {
                alert('aki')
                return false
            }
        },
        created: function () {
            elementProfile.classList.remove("hide")
        },
        mounted: function () {
            this.applyMask()
        }
    })
}
