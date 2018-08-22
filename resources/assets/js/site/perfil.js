var elemento = document.getElementById("el-form");
if (elemento != null) {
    var appVuePerfil = new Vue({
        el:'#el-form',
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
            }
        },
        created: function () {
            this.hide.content = false;
        }
    })
}

// FUNÇÕES DIVERSAS
function checarSelecao(){
    if (parseInt($('#w').val())){
        return true
    }
    alertaPagina('Selecione a área para recorte.','danger');
    return false;
}

function buscaCEP(cep){
    var cep = cep.replace(/\D/g, '');
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
            $("input[name='endereco']").val(".....");
            $("input[name='bairro']").val(".....");
            $("input[name='cidade']").val(".....");

            $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    $("input[name='endereco']").val(dados.logradouro);
                    $("input[name='bairro']").val(dados.bairro);
                    $("input[name='cidade']").val(dados.localidade);
                    $("input[name='uf']").val(dados.uf);
                } else {
                    limpaEndereco();
                    alert("CEP não encontrado.");
                }
            });
        } else {
            limpaEndereco();
            alert("Formato de CEP inválido.");
        }
    } else {
        limpaEndereco();
    }
}

function limpaEndereco(){
    $("input[name='endereco']").val("");
    $("input[name='bairro']").val("");
    $("input[name='cidade']").val("");
    $("input[name='uf']").val("");
}
