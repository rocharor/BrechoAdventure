<div class="modal-dialog">
    <div class="modal-content">
        <form name='form' action="/minha-conta/mensagem/store" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="produto_id" value="">

            <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body" >
                <h2 align="center"><span id='titulo'>Mensagem</span></h2>

                <p><label>De: &nbsp;</label><span class='mensagem_de'></span></p>
                <p><label>Para: &nbsp;</label><span class='mensagem_para'></span></p>
                <p><label>Produto: &nbsp;</label><span class='mensagem_produto'></span></p>
                <p><label>Mensagem: &nbsp;</label><textarea class='form-control' name="mensagem" rows="8" cols="50" required="required"></textarea></p>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" value='Enviar'/>
            </div>
        </form>
    </div>
</div>
