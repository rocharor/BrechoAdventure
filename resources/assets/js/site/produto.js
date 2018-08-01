// if (document.getElementById("el-produtos-minha-conta") != null) {
//     var appProdutosMinhaConta = new Vue({
//         el:'#el-produtos-minha-conta',
//         data:{},
//         methods:{
//             deletePhoto:function(nm_photo, product_id){
//                 if (confirm('Deseja realmente excluir esta foto?')) {
//
//                     axios.post('/minha-conta/produto/delete-foto', {
//                         nm_foto: nm_photo,
//                         produto_id: product_id
//                     })
//                     .then(retorno => {
//                         if (retorno.data.sucesso = true) {
//                             window.location.reload();
//                         } else {
//                             alertaPagina(retorno.data.msg, 'danger');
//                         }
//                     })
//                     .catch(error => {
//                         alertaPagina('Erro no sistema!', 'danger');;
//                         console.log(error)
//                     })
//                 }
//             },
//         },
//         created:function () {
//             var elemento = document.getElementById("el-produtos-minha-conta");
//             if (elemento != null) {
//                 elemento.classList.remove("hide");
//             }
//         }
//     });
// }
