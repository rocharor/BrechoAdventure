var appVueFiltro = new Vue({
    el:'#filtro_lateral',
    data:{
        categorias:[],
        inputPalavraChave:'',
        arrPalavrasChaves:[],
        checksSelecionados:[],
        disabledChecks:false
    },
    methods:{
        buscaDadosFiltro:function(){
            var queryString = appVueFiltro.getQueryString();

            $.post( "/produto/busca-filtro", {parametro: queryString}, function( data ) {
                appVueFiltro.categorias = $.parseJSON(data);
                appVueFiltro.checaItens();
            });
        },
        guardaCheck:function(item){
            appVueFiltro.disabledChecks = true;
            var tipo = item[0].toLowerCase();
            var valor = typeof item[1] == 'string' ? item[1].toLowerCase() : item[1];

            if (appVueFiltro.checksSelecionados[tipo] != null) {
                var key = appVueFiltro.checksSelecionados[tipo].indexOf(valor);
                if (key >= 0) {
                    // delete appVueFiltro.checksSelecionados[tipo][key];
                    appVueFiltro.checksSelecionados[tipo].splice(key,1);
                }else{
                    appVueFiltro.checksSelecionados[tipo].push(valor);
                }
            }else{
                appVueFiltro.checksSelecionados[tipo] = [valor];
            }

            var query = [];
            var j = 0;
            for (var i in appVueFiltro.checksSelecionados) {
                if (appVueFiltro.checksSelecionados[i].length > 0) {
                    query[j] = i + '=' + appVueFiltro.checksSelecionados[i].join(',');
                    j++;
                }
            }


            var queryString = query.join('&');
            var url = '/produtos';
            if (queryString != '') {
                var url = '?' + queryString;
            }

            window.open(url,'_self');
        },
        checaItens:function(){
            var $queryString = appVueFiltro.getQueryString();

            var arrItens = [];
            for (var i in $queryString) {
                arrItens = $queryString[i].split(',');
                for (var j in arrItens) {
                    if (appVueFiltro.categorias['Categoria']['itens'][arrItens[j]] != null) {
                        appVueFiltro.categorias['Categoria']['itens'][arrItens[j]]['checked'] = true;
                    }

                    if (appVueFiltro.categorias['Estado']['itens'][arrItens[j]] != null) {
                        appVueFiltro.categorias['Estado']['itens'][arrItens[j]]['checked'] = true;
                    }

                    // guardo os checkbox que estão checados
                    if (appVueFiltro.checksSelecionados[i] != null) {
                        appVueFiltro.checksSelecionados[i].push(arrItens[j])
                    }else{
                        appVueFiltro.checksSelecionados[i] = [arrItens[j]]
                    }
                }
            }
        },
        getQueryString:function(){
            var query = location.search.slice(1);
            var partes = [];
        	var data = {};
            if (query) {
                partes = query.split('&');
            	partes.forEach(function (parte) {
            		var chaveValor = parte.split('=');
            		var chave = chaveValor[0];
            		var valor = chaveValor[1];
            		data[chave] = valor;
            	});
            }

        	return data;
        },
        palavraChave:function(){
            var value = this.inputPalavraChave
            this.arrPalavrasChaves.push(value)
            this.inputPalavraChave = '';
        },
        excluiPalavraChave: function(key){
            var arrAux = this.arrPalavrasChaves;
            this.arrPalavrasChaves = [];
            delete arrAux[key];
            for (var i in arrAux) {
                this.arrPalavrasChaves.push(arrAux[i])
            }
        }
    }
});
