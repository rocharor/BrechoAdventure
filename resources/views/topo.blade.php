<!-- BARRA TOPO -->
<div class="menu hidden-xs">
    <div class='topo_esquerdo '>
        <img src="/imagens/logo.jpg" alt="Brecho Aventure" class='img_logo'>
        <div class="links">
            <a {{ Request::route()->getName() == 'home' ? 'class=active' : '' }} href="{{ Route('home') }}">Home</a>
            <a {{ Request::route()->getName() == 'todosProdutos' ? 'class=active' : '' }} href="{{ Route('todosProdutos') }}">Todos Produtos</a>
            <a {{ Request::route()->getName() == 'contato' ? 'class=active' : '' }} href="{{ Route('contato') }}">Contato</a>
        </div>
    </div>

    <div class="topo_direito">
        @if(Auth::check() == 0)
            <div>
                <a href='/login' class="btn btn-login">Login</a>
                <a href='/cadastre-se' class="btn btn-cadastro">Cadastre-se</a>
            </div>
        @else
            <span class="btn-group">
                <a class="dropdown-toggle box" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/imagens/cadastro/{{ Auth::user()->nome_imagem}}" alt="Brecho Aventure" title="Minha conta" class="imagem_login img-circle">
                    <div class="mask img-circle" align='center'><span class="">Minha <br />Conta</span></div>
                </a>
                <ul class="dropdown-menu menu_logado">
                    <li><a href="{{ Route('minha-conta.createProduto') }}">Inserir Produtos</a></li>
                    <li><a href="{{ Route('minha-conta.perfil') }}">Meu Perfil</a></li>
                    <li><a href="{{ Route('minha-conta.meusProduto') }}">Meus Produtos</a></li>
                    <li><a href="{{ Route('minha-conta.meusFavorito') }}">Meus Favoritos</a></li>
                    <li><a href="{{ Route('minha-conta.mensagem') }}">Mensagens - <span class='qtdMsg'>0</span></a></li>
                    @can('admin')
                        <li><a href="{{ Route('admin.home') }}">Admin</a></li>
                    @endcan
                    <li><a href='/logout'>Sair</a></li>
                </ul>
            </span>
        @endif
    </div>
</div>

<div class="menu-mobile hidden-sm hidden-md hidden-lg">
    <div class='topo_esquerdo '>
        <img src="/imagens/logo.jpg" alt="Brecho Aventure" class='img_logo_mobile hidden-sm hidden-md hidden-lg'>
        <div class="links" style="font-size:7px">
            <a {{ Request::route()->getName() == 'home' ? 'class=active' : '' }} href="{{ Route('home') }}">Home</a>
            <a {{ Request::route()->getName() == 'todosProdutos' ? 'class=active' : '' }} href="{{ Route('todosProdutos',1) }}">Todos Produtos</a>
            <a {{ Request::route()->getName() == 'contato' ? 'class=active' : '' }} href="{{ Route('contato') }}">Contato</a>
        </div>
    </div>

    <div class="topo_direito">
        @if(Auth::check() == 0)
            <div class="dropdown">
            	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            		<span class="glyphicon glyphicon-menu-hamburger"></span>
            	</button>
            	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="margin: 2px -120px 0;">
                    <li><a href='/login' >Login</a></li>
                    <li><a href='/cadastre-se'>Cadastre-se</a></li>
            	</ul>
            </div>
        @else
            <span class="btn-group">
                <a class="dropdown-toggle box" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/imagens/cadastro/{{ Auth::user()->nome_imagem}}" alt="Brecho Aventure" title="Minha conta" class="imagem_login img-circle">
                    <div class="img-circle" align='center'></div>
                </a>
                <ul class="dropdown-menu menu_logado">
                    <li><a href="{{ Route('minha-conta.createProduto') }}">Inserir Produtos</a></li>
                    <li><a href="{{ Route('minha-conta.perfil') }}">Meu Perfil</a></li>
                    <li><a href="{{ Route('minha-conta.meusProduto') }}">Meus Produtos</a></li>
                    <li><a href="{{ Route('minha-conta.meusFavorito') }}">Meus Favoritos</a></li>
                    <li><a style='display:inline' href="{{ Route('minha-conta.mensagem') }}">Mensagens</a><span class='qtdMsg'>0</span></li>
                    @if(Auth::user()->id == 1)
                        <li><a href="{{ Route('admin.home') }}">Admin</a></li>
                    @endif
                    <li><a href='/logout'>Sair</a></li>
                </ul>
            </span>
        @endif
    </div>
</div>

<!-- IMAGEM FUNDO -->
<div class="img_fundo">
    <img src="/imagens/banner.jpg" width="100%" />
</div>

<!-- BUSCA -->
<div class='campo-buscar'>
    <div class="input-group hidden-xs">
    	<input type="text" class="form-control busca" placeholder="Buscar">
    	<div class="btn-group input-group-btn">
    		<button class="btn btn-primary">&nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;
    		</button>
    	</div>
    </div>
</div>

<br style="clear:both;"/><br>

<script type="text/javascript" src="/js/site/topo.js"></script>

<script type="text/javascript">
    if (!empty({{ Auth::check() }})) {buscaNotificacao();}
</script>
