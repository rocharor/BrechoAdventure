@extends('template')
@section('content')
    <div id='el-message' class='hide'>

        {{-- BREADCRUMB --}}
        <div>
            <breadcrumb :data-breadcrumb="{{ $breadCrumb }}"/>
        </div>


        <ul class="nav nav-tabs nav-justified">
            <li role="presentation" :class="{'active': aba.enviada == true}" @click.prevent="alteraAba(1)">
                <a>
                    <b> Mensagens Enviadas </b>
                    {{-- <span @if($qtdConversasEnviadas > 0) class='text-danger' @else class='hide' @endif><b>({{ $qtdConversasEnviadas }})</b></span> --}}
                </a>
            </li>
            <li role="presentation" :class="{'active': aba.recebida == true}" @click.prevent="alteraAba(2)">
                <a>
                    <b> Mensagens Recebidas </b>
                    {{-- <span @if($qtdConversasRecebidas > 0) class='text-danger' @else class='hide' @endif><b>({{ $qtdConversasRecebidas }})</b></span> --}}
                </a>
            </li>
        </ul>

        <br>

        <div :class="{'hide': aba.enviada == false}">
            @if(count($conversas_enviadas) == 0)
                <div class="well" align="center"><b><i>Voc&ecirc; n&atilde;o possui nenhuma mensagem enviada</i></b></div>
            @else
                <h3>Conversas</h3>

                <br>

                <table class='table table-hover' style="background:#fff">
                    @foreach ($conversas_enviadas as $key=>$conversa)
                        <tr>
                            <td>{{ $conversa['produto']->titulo }}</td>
                            <td><img src='/imagens/produtos/400x400/{{ $conversa['produto']->imgPrincipal }}' width='100' height='100' /></td>
                            <td><button class="btn btn-danger" @click.prevent="excluiConversa({{ $conversa['mensagens'][0]->conversa_id }})">X</button></td>
                            <td><button class='btn btn-warning' @click.prevent="openTalk({{ $conversa['mensagens'][0]->conversa_id }})"><small>Responder</small></button></td>
                            <td>
                                <div class="conversa hide" id="conversa_{{ $conversa['mensagens'][0]->conversa_id }}">
                                    <form action="{{Route('minha-conta.update-mensagem')}}" method="post">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="conversa_id" value="{{ $conversa['mensagens'][0]->conversa_id }}">

                                        <div class='bloco-conversa'>
                                            @foreach ($conversa['mensagens'] as $mensagem)
                                                <div class="conversa-{{ $mensagem->posicao }}">
                                                    <small><i>{{ $mensagem->nome }} - {{ $mensagem->data }}</i></small>
                                                    <p>{{ $mensagem->mensagem }}</p>
                                                </div>
                                            @endforeach
                                        </div>

                                        <textarea name="resposta" rows="2" class="form-control" placeholder='Responda aqui ...' required></textarea>

                                        <br>

                                        <button type='submit' class='btn btn-primary'>Enviar</button>
                                        <button type='button' class='btn btn-danger' @click.prevent="closeTalk({{ $conversa['mensagens'][0]->conversa_id }})">Fechar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>


        <div :class="{'hide': aba.recebida == false}">
                @if(count($conversas_recebidas) == 0)
                    <div class="well" align="center"><b><i>Voc&ecirc; n&atilde;o possui nenhuma mensagem recebida</i></b></div>
                @else
                     <h3>Conversas</h3>

                    <br>

                    <table class='table table-hover' style="background:#fff">
                        @foreach ($conversas_recebidas as $conversa)
                            <tr>
                                <td>{{ $conversa['produto']->titulo }}</td>
                                <td><img src='/imagens/produtos/400x400/{{ $conversa['produto']->imgPrincipal }}' width='100' height='100' /></td>
                                <td><button class="btn btn-danger" @click.prevent="excluiConversa({{ $conversa['mensagens'][0]->conversa_id }})">X</button></td>
                                <td><button class='btn btn-warning' @click.prevent="openTalk({{ $conversa['mensagens'][0]->conversa_id }})"><small>Responder</small></button></td>
                                <td>
                                    <div class="conversa hide" id="conversa_{{ $conversa['mensagens'][0]->conversa_id }}">
                                        <form action="{{Route('minha-conta.update-mensagem')}}" method="post">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="conversa_id" value="{{ $conversa['mensagens'][0]->conversa_id }}">

                                            <div class='bloco-conversa'>
                                                @foreach ($conversa['mensagens'] as $mensagem)
                                                    <div class="conversa-{{ $mensagem->posicao }}">
                                                        <small><i>{{ $mensagem->nome }} - {{ $mensagem->data }}</i></small>
                                                        <p>{{ $mensagem->mensagem }}</p>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <textarea name="resposta" rows="2" class="form-control" placeholder='Responda aqui ...' required></textarea>

                                            <br>

                                            <button type='submit' class='btn btn-primary'>Enviar</button>
                                            <button type='button' class='btn btn-danger' @click.prevent="closeTalk({{ $conversa['mensagens'][0]->conversa_id }})">Fechar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>

    </div>
@endsection
