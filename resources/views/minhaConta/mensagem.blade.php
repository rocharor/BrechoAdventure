@extends('template')
@section('content')

    <!--BREADCRUMB-->
    @include('breadCrumb')

    <div id='el-mensagem'>
        <ul class="nav nav-tabs nav-justified">
          <li role="presentation" :class="{'active': aba.enviada == true}" @click.prevent="alteraAba(1)">
              <a>Mensagens Enviadas
                  <span @if($qtdConversasEnviadas > 0) class='text-danger' @else class='hide' @endif><b>({{ $qtdConversasEnviadas }})</b></span>
              </a>
          </li>
          <li role="presentation" :class="{'active': aba.recebida == true}" @click.prevent="alteraAba(2)">
              <a>Mensagens Recebidas
                  <span @if($qtdConversasRecebidas > 0) class='text-danger' @else class='hide' @endif><b>({{ $qtdConversasRecebidas }})</b></span>
              </a>
          </li>
        </ul>

        <br />

        <div :class="{'hide': aba.enviada == false}">
            <div class="panel panel-default">
                @if(count($conversas_enviadas) == 0)
                     <div class="well" align="center"><b><i>Voc&ecirc; n&atilde;o possui nenhuma mensagem</i></b></div>
                @else
                    <div class="panel-heading">
                      <h4>Conversas</h4>
                    </div>
                    @foreach ($conversas_enviadas as $key=>$conversa)
                        @if($key%2 == 1)
                            <div class="panel-body" style="background-color:#eee">
                        @else
                            <div class="panel-body">
                        @endif
                            <div class="mensagem">
                                <span @if($conversa['naoLidas'] > 0) class='text-danger' @else class='hide' @endif >
                                    <b>({{ $conversa['naoLidas'] }})</b>
                                </span>
                                <div class="titulo">
                                    {{ $conversa['produto']->titulo }}
                                </div>
                                <div class="img">
                                    <img src='/imagens/produtos/200x200/{{ $conversa['produto']->imgPrincipal }}' width='100' height='100' />
                                </div>
                                <div class="excluir">
                                    <button class="btn btn-danger" @click.prevent="excluiConversa({{ $conversa['mensagens'][0]->conversa_id }})">X</button>
                                </div>
                                <div class="responder">
                                    <button class='btn btn-warning' @click.prevent="abreConversa({{ $conversa['mensagens'][0]->conversa_id }})"><small>Responder</small></button>
                                </div>
                                {{-- <div class="responder"><button class='btn btn-warning act-abre-conversa' data-status=1><small>Responder</small></button></div> --}}

                                {{-- <div class="conversa hide" data-conversa-id="{{ $conversa['mensagens'][0]->conversa_id }}"> --}}
                                <div class="conversa hide" id="conversa_{{ $conversa['mensagens'][0]->conversa_id }}">
                                    <form action="{{Route('minha-conta.update-mensagem')}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="conversa_id" value="{{ $conversa['mensagens'][0]->conversa_id }}">
                                        {{-- <div class="conversa_{{ $conversa['mensagens'][0]->conversa_id }}"> --}}
                                        <div>
                                            @foreach ($conversa['mensagens'] as $mensagem)
                                                <div class="conversa-{{ $mensagem->posicao }}">
                                                    <small><i>{{ $mensagem->nome }} - {{ $mensagem->data }}</i></small>
                                                    <p>{{ $mensagem->mensagem }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <br>
                                        {{-- <textarea name="resposta" id="resposta_{{ $conversa['mensagens'][0]->conversa_id }}" cols="5" rows="10" class="form-control" required placeholder='Responda aqui ...'></textarea> --}}
                                        {{-- <button class='btn btn-primary act-enviar-resposta' data-tipo='1'>Enviar</button> --}}
                                        <textarea name="resposta" cols="5" rows="10" class="form-control" placeholder='Responda aqui ...' required></textarea>
                                        <br>
                                        <button type='submit' class='btn btn-primary'>Enviar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div :class="{'hide': aba.recebida == false}">
            <div class="panel panel-default">
                @if(count($conversas_recebidas) == 0)
                     <div class="well" align="center"><b><i>Voc&ecirc; n&atilde;o possui nenhuma mensagem</i></b></div>
                @else
                    <div class="panel-heading">
                      <h4>Conversas</h4>
                    </div>
                    @foreach ($conversas_recebidas as $conversa)
                        <div class="panel-body">
                            <div class="mensagem">
                                <span @if($conversa['naoLidas'] > 0) class='text-danger' @else class='hide' @endif >
                                    <b>({{ $conversa['naoLidas'] }})</b>
                                </span>
                                <div class="titulo">{{ $conversa['produto']->titulo }}</div>
                                <div class="img"><img src='/imagens/produtos/200x200/{{ $conversa['produto']->imgPrincipal }}' width='100' height='100' /></div>
                                <div class="excluir"><button class="btn btn-danger">X</button></div>
                                <div class="responder"><button class='btn btn-warning' @click.prevent="abreConversa({{ $conversa['mensagens'][0]->conversa_id }})"><small>Responder</small></button></div>
                                {{-- <div class="responder"><button class='btn btn-warning act-abre-conversa' data-status=1><small>Responder</small></button></div> --}}

                                {{-- <div class="conversa hide" data-conversa-id="{{ $conversa['mensagens'][0]->conversa_id }}"> --}}
                                <div class="conversa hide" id="conversa_{{ $conversa['mensagens'][0]->conversa_id }}">
                                    <form action="{{Route('minha-conta.update-mensagem')}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="conversa_id" value="{{ $conversa['mensagens'][0]->conversa_id }}">
                                        {{-- <div class="conversa_{{ $conversa['mensagens'][0]->conversa_id }}"> --}}
                                        <div >
                                            @foreach ($conversa['mensagens'] as $mensagem)
                                                <div class="conversa-{{ $mensagem->posicao }}">
                                                    <small><i>{{ $mensagem->nome }} {{ $mensagem->data }}</i></small>
                                                    <p>{{ $mensagem->mensagem }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <br />
                                        {{-- <textarea name="resposta" id="resposta_{{ $conversa['mensagens'][0]->conversa_id }}" cols="5" rows="10" class="form-control" placeholder='Responda aqui ...'></textarea> --}}
                                        {{-- <button class='btn btn-primary act-enviar-resposta' data-tipo='2'>Enviar</button> --}}
                                        <textarea name="resposta" cols="5" rows="10" class="form-control" placeholder='Responda aqui ...' required></textarea>
                                        <br>
                                        <button type='submit' class='btn btn-primary'>Enviar</button>
                                    </form>
                                </div>
                            </div>

                            <hr />
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
        <script type="text/javascript" src="/js/site/mensagem.js"></script>
    </div>
@endsection
