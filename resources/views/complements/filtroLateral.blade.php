<div id="filtro_lateral">
    <!-- INICIO Campo palavra-chave -->
    {{-- <div class='palavra-chave'>
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
    </div> --}}
    <!-- FIM Campo palavra-chave -->

    <div class="categoria" v-for='(item, index) in categorias'>
        <div class='titulo'>
            @{{index}}
        </div>

        <div class="conteudo" v-for='item_2 in item.itens'>
            <label>
                <input type="checkbox" @change.prevent='guardaCheck([index, item_2.slug])' :checked="item_2.checked === true" :disabled="disabledChecks == true" />
                &nbsp;&nbsp;<span>@{{ item_2.rotulo }}</span>
                <small style="text-align:center">@{{ item_2.qtd }}</small>
            </label>
        </div>
    </div>
</div>
