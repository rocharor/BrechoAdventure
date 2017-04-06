<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" >
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body" >
            <h2 align="center"><span id='titulo'></span></h2>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators indicadores">
			  		<!-- INDICADORES -->
			  	</ol>
                <div class="carousel-inner produto_fotos" id='fotos' role="listbox">
                	<div class='item active'></div>
                    <!-- IMAGENS -->
                </div>

                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <hr>
            <p><label>Titulo: &nbsp;</label><span>@{{dataDescription.titulo}}</span></p>
            <p><label>Descrição: &nbsp;</label><span>@{{dataDescription.descricao}}</span></p>
            <p><label>Estado: &nbsp;</label><span>@{{dataDescription.estado}}</span></p>
            <p><label>Preço: &nbsp;</label><span>@{{dataDescription.valor}}</span></p>
            <hr>
            <p><label>Nome: &nbsp;</label><span>@{{dataDescription.name}}</span></p>
            <p><label>Email: &nbsp;</label><span>@{{dataDescription.email}}</span></p>
            <p><label>Telefones: &nbsp;</label><span>@{{dataDescription.fixo}} / @{{dataDescription.cel}}</span></p>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>
</div>
