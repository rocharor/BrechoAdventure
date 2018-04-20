<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 div-produtos">
    <div class='box-favorite'>
        @if(Auth::check() == 0)
            <div class='favorite' @click.prevent='setFavorite(0)'><span class='glyphicon glyphicon-star inactive'></span></div>
        @else
            @if($produto->favorito)
                <div class='favorite' @click.prevent='setFavorite({{ $produto->id }})'><span class='glyphicon glyphicon-star star-{{ $produto->id }} active'></span></div>
            @else
                <div class='favorite' @click.prevent='setFavorite({{ $produto->id }}, this)'><span class='glyphicon glyphicon-star star-{{ $produto->id }} inactive'></span></div>
            @endif
        @endif
    </div>

    <div class='titulo'>
        <b>{{ $produto->titulo }}</b>
    </div>
    <div class='image'>
        <img class="img-thumbnail" src="/imagens/produtos/200x200/{{ $produto->imgPrincipal }}">
    </div>

    <div>
        <b>Pre&ccedil;o: R$ {{$produto->valor}}</b>
    </div>

    <div>
        <a href='{{ Route('visualizar-produto',$produto->slug) }}' class='btn btn-warning'><b>Ver detalhes</b></a>
        @if(Auth::check() == 0)
            <button class='btn btn-info' title='Necessário estar logado' disabled><span class="glyphicon glyphicon-envelope"></span></button>
        @elseif(Auth::user()->id == $produto->user->id)
            <button class='btn btn-info' title='Este produto é seu' disabled><span class="glyphicon glyphicon-envelope"></span></button>
        @else
            <button class='btn btn-info' @click.prevent="openContact({{ $produto->id }})"><span class="glyphicon glyphicon-envelope"></span></button>
        @endif
    </div>
</div>