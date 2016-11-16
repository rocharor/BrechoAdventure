<!-- BARRA TOPO -->
<div class="menu">
    <div class='topo_esquerdo '>
        <img src="/imagens/logo.jpg" alt="Brecho Aventure" class='img_logo hidden-xs'>
        <img src="/imagens/logo.jpg" alt="Brecho Aventure" class='img_logo_mobile hidden-sm hidden-md hidden-lg'>
        <span class='nome_site hidden-xs'>BRECHÓ ADVENTURE</span>
    </div>

    <div class="topo_direito">
        @if(Auth::check() == 0)
            {{-- <button class="btn btn-primary btn-login">Login</button> --}}
            {{-- <button class="btn btn-success btn-cadastro">Cadastre-se</button> --}}
            <a href='/login' class="btn btn-login">Login</a>
            <a href='/cadastre-se' class="btn btn-cadastro">Cadastre-se</a>
        @else
            <span class="btn-group">
                <a class="dropdown-toggle box" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/imagens/cadastro/padrao.jpg" alt="Brecho Aventure" title="Minha conta" class="imagem_login img-circle">
                    <div class="mask img-circle" align='center'><span class="">Minha <br />Conta</span></div>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ Route('mcperfil') }}">Meu Perfil</a></li>
                    <li><a href="{{ Route('mcproduto') }}">Meus Produtos</a></li>
                    <li><a href="{{ Route('mcfavorito') }}">Meus Favoritos</a></li>
                </ul>
            </span>
            <a href="/minha-conta/cadastro-produto" class="btn btn-warning btn-inserir-produto">Inserir Produtos</a>
            <a href='/logout' class="btn btn-danger">Sair</a>
        @endif
    </div>

</div>

<!-- IMAGEM FUNDO -->
<img src="/imagens/banner.jpg" width="100%" />

<!-- Menu desktop -->
<div class='section hidden-xs' id='crosscol'><div class='widget PageList' data-version='1' id='PageList98'>
    <div class='art-nav-inner'>
        <ul class='art-hmenu'>
            <li><a class='{$active_1}' href="{{ Route('home') }}"><small>Brecho Adventure</small></a></li>
            <li><a class='{$active_2}' href="{{ Route('produto') }}"><small>Produtos</small></a></li>
            <li><a class='{$active_3}' href="{{ Route('contato') }}"><small>Contato</small></a></li>
        </ul>
    </div>
    </div>
</div>

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


<!-- BUSCA -->
<div class="input-group campo-buscar hidden-xs">
	<input type="text" class="form-control busca" placeholder="Buscar">
	<div class="btn-group input-group-btn">
		<button class="btn btn-primary act-buscar">&nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;
		</button>
	</div>
</div>

{{--
<!-- MODAL -->
<!--Modal Login-->
<div class="modal fade" id='login'>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Login <img src="/imagens/logo.jpg" alt="Brecho Aventure" width="15%"></h4>
            </div>
            <div class="modal-body">
                <span class='msg_login'></span>
           		<label>Email: <input type="text"class="form-control" id="email_login" style="width: 300px;"  /></label>
               	<label>Senha: <input type="password" class="form-control" id="senha_login" style="width: 300px;" /></label>
               	<div><small><i><a class='act-esqueci-senha btn-esqueci-senha'>Esqueci a senha</a></i></small></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary act-login">Logar</button>
            </div>
        </div>
    </div>
</div>


<!--Modal esqueci_senha-->
<div class="modal fade" id='esqueci_senha'>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2>Esqueci a senha</h2>
            </div>

            <div class="modal-body">
                <label>
                    Informe seu email de cadastro: <input type="text" class="form-control" id = 'email_reenviar_senha' style="width: 300px;" />
                </label>
                <img src="/imagens/carregando.gif" width="50" class="hide carregando" />
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary act-reenviar-senha">Reenviar senha</button>
            </div>
        </div>
    </div>
</div>

<!--Modal Cadastro-->
<div class="modal fade" id='cadastro'>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro <img src="/imagens/logo.jpg" alt="Brecho Aventure" width="15%"></h4>
            </div>

			<form action="/login/" method="post" name="form">
	            <div class="modal-body">
	                <label><span class='text-danger'>*</span> Nome: <input type="text" id='nome_cad' class="form-control" style="width: 300px;"  /></label><br>
	                <label>Apelido: <input type="text" id='apelido_cad' class="form-control" style="width: 300px;"  /></label><br>
	                <label><span class='text-danger'>*</span>  Email: <input type="text" id='email_cad' class="form-control" style="width: 300px;" /></label><br>
	                <label><span class='text-danger'>*</span> Senha: <input type="password" id='senha1_cad' class="form-control" style="width: 150px;" /></label>
	                <label><span class='text-danger'>*</span> Confimar senha: <input type="password" id='senha2_cad' class="form-control" style="width: 150px;" /></label>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	                <button type="button" class="btn btn-primary act-cadastro">Cadastrar</button>
	            </div>
            </form>
       </div>
    </div>
</div>

<script type="text/javascript" src="/js/login.js"></script>
<script type="text/javascript" src="/js/cadastro.js"></script> --}}
<script type="text/javascript" src="/js/padrao.js"></script>
