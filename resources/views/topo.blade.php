<!-- BARRA TOPO -->
<div class="menu">
    <div class='topo_esquerdo '>
        <img src="/imagens/logo.jpg" alt="Brecho Aventure" class='img_logo hidden-xs'>
        <img src="/imagens/logo.jpg" alt="Brecho Aventure" class='img_logo_mobile hidden-sm hidden-md hidden-lg'>
        {{-- <span class='nome_site hidden-xs'>BRECHÓ ADVENTURE</span> --}}
        <div class="links hidden-xs">
            <a {{ Request::route()->getName() == 'home' ? 'class=active' : '' }} href="{{ Route('home') }}">Home</a>
            <a {{ Request::route()->getName() == 'todosProdutos' ? 'class=active' : '' }} href="{{ Route('todosProdutos',1) }}">Todos Produtos</a>
            <a {{ Request::route()->getName() == 'contato' ? 'class=active' : '' }} href="{{ Route('contato') }}">Contato</a>
        </div>
        <div class="links hidden-md hidden-lg hidden-sm" style="font-size:7px">
            <a {{ Request::route()->getName() == 'home' ? 'class=active' : '' }} href="{{ Route('home') }}">Home</a>
            <a {{ Request::route()->getName() == 'todosProdutos' ? 'class=active' : '' }} href="{{ Route('todosProdutos',1) }}">Todos Produtos</a>
            <a {{ Request::route()->getName() == 'contato' ? 'class=active' : '' }} href="{{ Route('contato') }}">Contato</a>
        </div>
    </div>

    <div class="topo_direito">
        @if(Auth::check() == 0)
            <div class="hidden-xs">
                <a href='/login' class="btn btn-login">Login</a>
                <a href='/cadastre-se' class="btn btn-cadastro">Cadastre-se</a>
            </div>
            <div class="dropdown menu-mobile hidden-sm hidden-md hidden-lg">
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
                    <div class="mask img-circle" align='center'><span class="">Minha <br />Conta</span></div>
                </a>
                <ul class="dropdown-menu menu_logado">
                    <li><a href="{{ Route('minha-conta.cadastro-produto') }}">Inserir Produtos</a></li>
                    <li><a href="{{ Route('minha-conta.mcperfil') }}">Meu Perfil</a></li>
                    <li><a href="{{ Route('minha-conta.mcproduto') }}">Meus Produtos</a></li>
                    <li><a href="{{ Route('minha-conta.mcfavorito') }}">Meus Favoritos</a></li>
                    <li><a style='display:inline' href="{{ Route('minha-conta.mcmensagem') }}">Mensagens</a><span class='qtdMsg'>0</span></li>
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
<img src="/imagens/banner.jpg" width="100%" />

<!-- BUSCA -->
<div class="input-group campo-buscar hidden-xs">
	<input type="text" class="form-control busca" placeholder="Buscar">
	<div class="btn-group input-group-btn">
		<button class="btn btn-primary act-buscar">&nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;
		</button>
	</div>
</div>


<br style="clear:both;"/><br>

<script type="text/javascript">
if (!empty({{ Auth::check() }})) {buscaNotificacao();}
</script>
