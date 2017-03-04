<style media="screen">
#filtro_lateral{
  background-color:#E5E5E5;
  border:solid 2px  #D8D8D8;
  /*width:200px;*/
  width:100%;
  color:#808080;
}
#filtro_lateral > .categoria{
  margin:3px;
}
#filtro_lateral > .categoria > .titulo{
  background-color:#D8D8D8;
  padding:4px;
  font-weight:bold;
}
#filtro_lateral > .categoria > .titulo:hover{
  background-color:#4D4D4D;
  color:#fff;
  cursor:pointer;
}
#filtro_lateral > .categoria > .titulo > span{
  float:right;
  font-size:20px;
  margin-top:-5px;
}
#filtro_lateral > .categoria > .conteudo{
  background-color:#E5E5E5;
  margin-top:5px;
}
#filtro_lateral > .categoria > .conteudo > label{
  display:inline-block;
  width:100%;
  font-weight:normal;
}
#filtro_lateral > .categoria > .conteudo > label > small{
  float:right;
  width:35px;
  color: #4D4D4D;
  font-weight:bold;
  font-size:11px;
  border:solid 2px #4D4D4D;
  border-radius:10px;
}
#filtro_lateral > .categoria > .conteudo > label:hover{
  cursor:pointer;
}
#filtro_lateral > .categoria > .conteudo > label:hover span{
  text-decoration: underline;
}
#filtro_lateral > .categoria > .conteudo > label:hover small{
  color: #fff;
  background-color: #4D4D4D;
}

/*INICIO Checkbox*/
input[type="checkbox"]:before {
  padding: 7px;
  position: absolute;
  content: '';
  background: #fff;
  border-radius: 3px;
  box-shadow: 1px 1px 2px #333;
  /*   margin-left:-20px;   */
  /*    border: 1px solid ; */
}

input[type="checkbox"]:checked:before {
  padding: 7px;
  position: absolute;
  content: '';
  background: #fff;
  border-radius: 3px;
  box-shadow: 1px 1px 2px #333;
  background-size:cover;
  background-image: url('https://image.freepik.com/icones-gratis/marca-de-verificacao-do-doodle_318-34713.jpg');
  /*   margin-left:-40px; */
  /*   border: 1px solid ; */
}
/*FIM Checkbox*/



/*INICIO Campo palavra-chave*/
.palavra-chave{
  /*width:195px;*/
  width:100%;
  border: solid 0;
  margin:5px 0 10px 0;
}
.palavra-chave > .input-group > input:hover {
  border: solid #4D4D4D;
}

.palavra-chave > .input-group > .btn-group > button > span{
  color:#fff;
}
.palavra-chave > .input-group > .btn-group > button{
  background-color: #999999
}
.palavra-chave > div > .escolhas{
  display:inline-block;
  border:solid #CC2929;
  border-radius:15px;
  padding:2px 15px;
  margin-top:3px;
  position:relative;
  color:#CC2929;
  font-weight:bold;
}

.palavra-chave > div > .escolhas:hover{
  background-color:#CC2929;
  color:#fff;
  cursor:pointer
}

/*FIM Campo palavra-chave*/

.item-view{
  border:1px solid;
  height:200px
}


</style>

<div id="filtro_lateral">
<!-- INICIO Campo palavra-chave -->
<div class='palavra-chave'>
  <div class="input-group">
    <input type="text" class="form-control" placeholder='Palavra-chave' v-model='inputPalavraChave'>
    <div class="btn-group input-group-btn">
      <button class="btn" title="Inserir palavra" @click.prevent='palavraChave()'>
        &nbsp;<span class="glyphicon glyphicon glyphicon-plus"></span>&nbsp;
      </button>
    </div>
  </div>
  <div v-for='(item, index) in arrPalavrasChaves'>
    <div class='escolhas'>
      <div class='texto-escolha' title='Excluir' @click.prevent='excluiPalavraChave(index)'>@{{item}}</div>
    </div>
  </div>
</div>
<!-- FIM Campo palavra-chave -->

<div class="categoria" v-for='(item, index) in categorias'>
  <div class='titulo' @click.prevent="alteraCategoria(index)">
    @{{item.titulo}}
    <span v-if="item.menuAtivo == false">+</span>
    <span v-if="item.menuAtivo == true">-</span>
  </div>

  <div :class="{'hide': item.menuAtivo == false}" class="conteudo" v-for='(item_2, index_2) in item.itens'>
    <label>
      <input type="checkbox" @change.prevent='guardaCheck(index_2)' />&nbsp;&nbsp;<span>@{{ index_2 }}</span>
      <small align='center'>@{{ item_2 }}</small>
    </label>
  </div>
</div>
</div>


<script>
console.clear()

var appVue = new Vue({
  el:'#filtro_lateral',
  data:{
    categorias: [
      {
        'titulo': 'Titulo 1',
        'menuAtivo': 1,
        'itens': {
            'Categoria 1': 351,
            'Categoria 2': 3543,
            'Categoria 3': 6544,
          }

      },
      {
        'titulo': 'Titulo 2',
        'menuAtivo': 1,
        'itens': {
            'Categoria 4': 135,
            'Categoria 5': 354,
            'Categoria 6': 354,
          }

      }
    ],
    inputPalavraChave:'',
    arrPalavrasChaves:[],
    arrChecks:[]
  },
  methods:{
   alteraCategoria:function(key){
     console.log(key)
     this.categorias[key].menuAtivo = !this.categorias[key].menuAtivo;
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
   },
   guardaCheck:function(item){
     var key = this.arrChecks.indexOf(item)
     if (key >= 0) {
      var arrAux = this.arrChecks;
      this.arrChecks = [];
      delete arrAux[key];
       for (var i in arrAux) {
         this.arrChecks.push(arrAux[i])
       }
     }else{
      this.arrChecks.push(item)
     }

   }
  }
})





</script>
