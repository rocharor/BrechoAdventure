var appVueBusca = new Vue({
		el:'#sistemaBusca',
		data:{
			listProducts:[],
			listProductsAux:[],
			campoBusca:{
				input:'',
				result:false
			}
		},
		methods:{
			updateListProducts:function(){
				$.ajax({
					url: '/produto/getCacheProdutcts',
					dataType: 'json',
					type: 'POST',
					success: function(retorno){
						appVueBusca.listProducts = retorno;
						appVueBusca.listProductsAux = retorno;
					}
				})

			},
			// verifyProductsCache:function(){
			//     if (typeof(Storage) !== "undefined" ) {
			//         var timeProductsCache = window.sessionStorage.getItem('timeProductsCache');
			//         var now = new Date().getTime();
			//         var acrescimo = (5 * 1000) * 60;// 5 minutos
			//
			//         if (timeProductsCache == null || parseInt(now) > (parseInt(timeProductsCache) ) ) {
			//             this.updateListProducts();
			//             window.sessionStorage.setItem('timeProductsCache', parseInt(now) + parseInt(acrescimo) );
			//             return;
			//         }
			//         return;
			//     }else{
			//         this.updateListProducts();
			//         return;
			//     }
			// }
		},
		computed:{
			autoComplete:function(){
				if (this.campoBusca.input.length > 0){
					this.campoBusca.result = true;
				}else{
					this.campoBusca.result = false;
				}

				var value = this.campoBusca.input.toLowerCase();

				if (value != '') {
					var lista_filtro = this.listProductsAux.filter(function (item) {
						return item.titulo.toLowerCase().indexOf(value) > -1;
					});
					this.listProducts = lista_filtro;
					return;
				}
				this.listProducts = this.listProductsAux;
				return
		},
		created: function () {
			// $('#sistemaBusca').removeClass('hide');
		}
	}


});

appVueBusca.updateListProducts();
