$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });

var appProdutosSite = new Vue({
    el:'.el-produtos',
    data:{
        dataDescription:{
            titulo:'',
            descricao:'',
            estado:'',
            valor:'',
            name:'',
            email:'',
            fixo:'',
            cel:''
        },
        dataContact:{
            remetente:'',
            destinatario:'',
            titulo:'',
            produto_id:0,
            mensagem:''
        }

    },
    methods:{
        setFavorite:function(produto_id){

            if (produto_id == 0) {
                alertaPagina('Necessário estar logado para favoritar.','danger');
                return false;
            }

            $.ajax({
                url:'/minha-conta/favorito/storeFavorito',
                dataType: 'json',
                type: 'POST',
                data: {
                    'produto_id':produto_id
                },
                success: function(retorno){
                    var statusFavorito = window.sessionStorage.getItem('favorite-product-' + produto_id);
                    if (statusFavorito == null) {
                        window.sessionStorage.setItem('favorite-product-' + produto_id, retorno.status);
                    }else{
                        window.sessionStorage.setItem('favorite-product-' + produto_id, retorno.status);
                    }
                    statusFavorito = window.sessionStorage.getItem('favorite-product-' + produto_id);

                    if(retorno.success){
                        if(statusFavorito == 0){
                            var div_imagem = $('.produto-' + produto_id).find('.img-ativo');
                            div_imagem.addClass('img-inativo').removeClass('img-ativo');
                        }else{
                            var div_imagem = $('.produto-' + produto_id).find('.img-inativo');
                            div_imagem.addClass('img-ativo').removeClass('img-inativo');
                        }
                    }else{
                        alertaPagina('Erro ao salvar favorito.','danger');
                    }
                },
                error: function(retorno){
                    alertaPagina('Erro no sistema! cod-02','danger');
                }
            });
        },
        openContact:function(produto_id){
            this.dataContact.mensagem = '';

            $.ajax({
		        url: '/minha-conta/mensagem/create',
		        dataType: 'json',
		        type: 'POST',
		        data: {'produto_id': produto_id},
		        success: function(retorno){
                    appProdutosSite.dataContact.remetente = retorno.nome_remet;
                    appProdutosSite.dataContact.destinatario = retorno.name;
                    appProdutosSite.dataContact.titulo = retorno.titulo;
                    appProdutosSite.dataContact.produto_id = produto_id;
		        },
		        error:function(){
		            alertaPagina('Erro ao buscar dados.','danger');
		        }
		    });

		    $('#modal-mensagem').modal();
        },
        sendContact:function(){
            if (this.dataContact.mensagem == '') {
                alertaPagina('Campo mensagem não pode ser vazio','danger');
                return false;
            }

            $.ajax({
                url: '/minha-conta/mensagem/store',
                dataType: 'json',
                type: 'POST',
                data: {
                    produto_id: this.dataContact.produto_id,
                    mensagem:this.dataContact.mensagem
                },
                success: function(retorno){
                    if (retorno.success == 1) {
                        alertaPagina('Mensagem enviada com sucesso.','success');
                    }else{
                        alertaPagina('Erro ao enviar mensagem, tente novamente! [Cod=1]','danger');
                    }

                    $('#modal-mensagem').modal('hide');
                },
                error:function(){
                    alertaPagina('Erro ao enviar mensagem, tente novamente! [Cod=2]','danger');
                }
            });
        }
    },
    created:function () {
        $('.el-produtos').removeClass('hide');
    }
});

var appProdutosMinhaConta = new Vue({
    el:'#el-produtos-minha-conta',
    data:{},
    methods:{
        inactiveProduct:function(id){
            if (confirm('Deseja realmente inativar este produto?')) {
                window.open('/minha-conta/produto/inativar/' + id, '_self');
            }
        },
        deleteProduct:function(id){
            if (confirm('Deseja realmente excluir definitivamente este produto?')) {
                window.open('/minha-conta/produto/delete/' + id, '_self');
            }
        },
        deletePhoto:function(nm_photo, product_id){
            if (confirm('Deseja realmente excluir esta foto?')) {
                $.ajax({
                    url :'/minha-conta/produto/delete-foto',
                    type : 'post',
                    dataType : 'json',
                    data : {
                        'nm_foto' : nm_photo,
                        'produto_id' : product_id
                    },
                    success : function(retorno) {
                        if (retorno.sucesso = true) {
                            window.location.reload();
                        } else {
                            alertaPagina(retorno.msg, 'danger');
                        }
                    },
                    error : function() {
                        alertaPagina('Erro no sistema!', 'danger');;
                    }
                });
            }
        },
    },
    created:function () {
        document.getElementById("el-produtos-minha-conta").classList.remove("hide");
    }
});

// Mascaras
(function() {
    if (document.getElementById("valor") != null) {
        VMasker(document.getElementById("valor")).maskMoney();
    }
})();
