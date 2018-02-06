<div class="modal-dialog">
    <div class="modal-content">
        <input type="hidden" name="produto_id" value="">

        <div class="modal-header" >
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body" >
            <h2 align="center"><span id='titulo'>Mensagem</span></h2>

            <p><label>De: &nbsp;</label><span>@{{dataContact.remetente}}</span></p>
            <p><label>Para: &nbsp;</label><span>@{{dataContact.destinatario}}</span></p>
            <p><label>Produto: &nbsp;</label><span>@{{dataContact.titulo}}</span></p>
            <p><label>Mensagem: &nbsp;</label><textarea class='form-control' name="mensagem" rows="8" cols="50" required="required" id='campo-mensagem' v-model='dataContact.mensagem'></textarea></p>
        </div>
        <div class="modal-footer">
            <button type="button" class='btn btn-danger' name="button" data-dismiss="modal">Cancelar</button>
            <button type="button" class='btn btn-success act-enviar-mensagem' name="button" @click.prevent="sendContact()">Enviar</button>
        </div>

    </div>
</div>
