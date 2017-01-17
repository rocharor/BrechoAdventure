<!-- BARRA TOPO -->
<div class="menu">
    <div class='topo_esquerdo '>
        <img src="/imagens/logo.jpg" alt="Brecho Aventure" class='img_logo hidden-xs'>
        <img src="/imagens/logo.jpg" alt="Brecho Aventure" class='img_logo_mobile hidden-sm hidden-md hidden-lg'>
        <span class='nome_site hidden-xs'>BRECHÓ ADVENTURE</span>
    </div>

    <div class="topo_direito">
        @if(Auth::check() == 0)
            <a href='/login' class="btn btn-login">Login</a>
            <a href='/cadastre-se' class="btn btn-cadastro">Cadastre-se</a>
        @else
            <span class="btn-group">
                <a class="dropdown-toggle box" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/imagens/cadastro/{{ Auth::user()->nome_imagem}}" alt="Brecho Aventure" title="Minha conta" class="imagem_login img-circle">
                    <div class="mask img-circle" align='center'><span class="">Minha <br />Conta</span></div>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ Route('minha-conta.mcperfil') }}">Meu Perfil</a></li>
                    <li><a href="{{ Route('minha-conta.mcproduto') }}">Meus Produtos</a></li>
                    <li><a href="{{ Route('minha-conta.mcfavorito') }}">Meus Favoritos</a></li>
                    <li><a style='display:inline' href="{{ Route('minha-conta.mcmensagem') }}">Mensagens</a><span class='qtdMsg'>0</span></li>
                </ul>
            </span>
            @if(Auth::user()->id == 1)
                <a href="{{ Route('admin.home') }}" class="btn btn-primary">Admin</a>
            @endif
            <a href="{{ Route('minha-conta.cadastro-produto') }}" class="btn btn-warning btn-inserir-produto">Inserir Produtos</a>
            <a href='/logout' class="btn btn-danger">Sair</a>
        @endif
    </div>
</div>

<!-- IMAGEM FUNDO -->
<img src="/imagens/banner.jpg" width="100%" />

<!-- BUSCA -->
<div class="input-group campo-buscar hidden-xs">
	<input type="text" class="form-control busca" placeholder="Buscar">
	<div class="btn-group input-group-btn">
		<button class="btn btn-primary act-buscar">&nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;
		</button>
	</div>
</div>

{{-- <div class='section hidden-xs' id='crosscol' style="border:solid 1px">

    <div class='widget PageList' data-version='1' id='PageList98'>
        <div class='art-nav-inner'>
            <ul class='art-hmenu'>
                <li><a class='{$active_1}' href="{{ Route('home') }}"><small>Brecho Adventure</small></a></li>
                <li><a class='{$active_2}' href="{{ Route('produto') }}"><small>Produtos</small></a></li>
                <li><a class='{$active_3}' href="{{ Route('contato') }}"><small>Contato</small></a></li>
            </ul>
        </div>
    </div>
</div> --}}

<!-- Menu desktop -->
<nav class="menu_link hidden-xs">
    <ul>
        <li><a {{ (Request::is('/') ? 'class=active' : '') }} href="{{ Route('home') }}">Brecho Adventure</a></li>
        <li><a {{ (Request::is('produto') ? 'class=active' : '') }} href="{{ Route('produto') }}">Produtos</a></li>
        <li><a {{ (Request::is('contato') ? 'class=active' : '') }} href="{{ Route('contato') }}">Contato</a></li>
    </ul>
</nav>

<!-- Menu Mobile -->
<div class="dropdown menu-mobile hidden-sm hidden-md hidden-lg">
	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		<span class="glyphicon glyphicon-menu-hamburger"></span>
	</button>
	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		<li><a href="{{ Route('home') }}">Brecho Adventure</a></li>
		<li><a href="{{ Route('produto') }}">Produtos</a></li>
		<li><a href="{{ Route('contato') }}">Contato</a></li>
	</ul>
</div>

<br style="clear:both;"/><br>

<script type="text/javascript">
if (!empty({{ Auth::check() }})) {buscaNotificacao();}
</script>
