<header class="main-header">
    <!-- LOGO -->
    <a href="{{ Route('admin.home') }}" class="logo">
        <span class="logo-mini"><b>B</b>A</span>
        <span class="logo-lg"><b>Brecho</b>Adventure</span>
    </a>

    {{-- MENU TOPO--}}
    <nav class="navbar navbar-static-top">
        <a href="" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Alterar navegação</span>
        </a>

        {{-- NOTIFICAÇÕES --}}
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @can('admin-pendente')
                    {{-- PRODUTOS --}}
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label @if(count($data['produtosPendentes']) > 0) label-danger @else label-success @endif">
                                {{ count($data['produtosPendentes']) }}
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">
                                Você tem  {{ count($data['produtosPendentes']) }} produtos pedentes
                            </li>
                            <li>
                                <ul class="menu">
                                    @foreach($data['produtosPendentes'] as $produto)
                                        <li>
                                            <a href="{{ Route('admin.pendente.product-view', $produto->id) }}">
                                                <div class="pull-left" style="margin-right:5px">
                                                  <img src="/imagens/produtos/200x200/{{ $produto->imgPrincipal }}" class="img-circle" alt="User Image" style="width: 45px; height: 45px;">
                                                </div>

                                                <h4>{{ $produto->titulo }}</h4>
                                                <p>
                                                    @if (strlen($produto->descricao) > 30)
                                                        {{ substr($produto->descricao,0,30) }} ...
                                                    @else
                                                        {{ $produto->descricao }}
                                                    @endif
                                                </p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="{{ Route('admin.pendente.product-list') }}">Ver todos produtos</a>
                            </li>
                        </ul>
                    </li>

                    {{-- CONTATOS --}}
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label @if(count($data['contatosPendentes']) > 0) label-danger @else label-success @endif">
                                {{ count($data['contatosPendentes']) }}
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">
                                Você tem  {{ count($data['contatosPendentes']) }} mensagens
                            </li>
                            <li>
                                <ul class="menu">
                                    @foreach($data['contatosPendentes'] as $contato)
                                        <li>
                                            <a href="{{ Route('admin.pendente.contact-view', $contato->id) }}" style="margin: 0 -30px">
                                                <h4>{{ $contato->tipo }}</h4>
                                                <p>
                                                    @if (strlen($contato->mensagem) > 40)
                                                        {{ substr($contato->mensagem,0,40) }} ...
                                                    @else
                                                        {{ $contato->mensagem }}
                                                    @endif
                                                </p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="{{ Route('admin.pendente.contact-list') }}">Ver todas mensagens</a>
                            </li>
                        </ul>
                    </li>
                @endcan
                {{-- USER --}}
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/imagens/cadastro/{{ Auth::user()->nome_imagem}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->name}} - <b>Administrador</b></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="/imagens/cadastro/{{ Auth::user()->nome_imagem}}  " class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::user()->name}} - <b>Administrador</b>
                                <small>{{ Auth::user()->created_at}}</small>
                            </p>
                        </li>

                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ Route('minha-conta.perfil') }}" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="/logout" class="btn btn-default btn-flat">Sair</a>
                            </div>
                        </li>
                    </ul>
                </li>

                {{-- <li> --}}
                    {{-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> --}}
                {{-- </li> --}}
            </ul>
        </div>
    </nav>
</header>
