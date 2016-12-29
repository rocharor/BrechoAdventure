@extends('template')
@section('content')
    <style>
    .mensagem{
      border:solid 0px red;
      position:relative;
    }

    .mensagem div{
    /*   display:inline-block; */
    }

    .titulo{
      border:solid 0px green;
      width:70%;
      display:inline-block;
    }

    .img{
      border:solid 0px orange;
      display:inline-block;
    }

    .excluir{
      border:solid 0px yellow;
      position:absolute;
      top:5px;
      right:5px;
    }

    .responder{
      border:solid 0px blue;
      position:absolute;
      background-color:#FF8F1E;
      bottom:0;
      right:5px;
    }

    .responder a{
      text-decoration:none;
      color:#000;
    }

    .conversa{
      border:solid 0px blue;
    /*   position:relative;    */
      width:70%;
    }

    .conversa-esquerda{
      border:solid 0px red;
      background-color: #FFB520;
      border-radius:10px;
      width:50%;
      margin-right: auto;
      padding:10px
    }


    .conversa-direita{
      border:solid 0px green;
      background-color: #FFD786;
      border-radius:10px;
      width:50%;
      margin-left: auto;
      padding:10px
    }

    </style>
    <h1 class="text-danger"><span class="glyphicon glyphicon-envelope"></span> Mensagens</h1>

    <ul class="nav nav-tabs nav-justified">
      <li role="presentation" class="active act-aba-msgEnviadas"><a href="#">Mensagens Enviadas</a></li>
      <li role="presentation" class='act-aba-msgMeusProdutos'><a href="#">Mensagens Meus Produtos</a></li>
    </ul>
    <br />

    <div class="aba-msgEnviadas">
        <div class="panel panel-default">
            <div class="panel-heading">
              <h4>Titulo</h4>
            </div>
            <div class="panel-body">
                <div class="mensagem">
                    <div class="titulo">Produto</div>
                    <div class="img"><img src='http://www.interne.com.br/novidades/images/fotos_materias/Arvore-dia-saude210915.jpg' width='100'/></div>
                    <div class="excluir"><button class="btn btn-danger">X</button></div>
                    <div class="responder"><a class='act-conversa' data-status=1 href=""><small>Responder</small></a></div>

                    <div class="conversa hide">
                        <div class="conversa-esquerda">
                            <small><i>Fulano 31/12/2016</i></small>
                            <p>teste left</p>
                        </div>
                        <div class="conversa-direita">
                            <small><i>Fulano 31/12/2016</i></small>
                            <p>teste direita</p>
                        </div>
                        <br />
                        <div class='textarea'>
                            <textarea name="" id="" cols="5" rows="10" class="form-control" placeholder='Responda aqui ...'></textarea>
                            <button class='btn btn-primary'>Enviar</button>
                        </div>
                    </div>
                </div>

                <hr />
            </div>
        </div>
    </div>

    <div class="aba-msgMeusProdutos hide">
        Meus Produtos
    </div>

    <script type="text/javascript" src="/js/site/mensagem.js"></script>
@endsection
