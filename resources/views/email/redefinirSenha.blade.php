@extends('email.template')
@section('content')
    <tr>
        <td class="corpoEmail">
            <h2>Oláaaa!</h2>
            <p>Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para sua conta.</p><br>
            <div align='center'>
                <a href="{{ $actionUrl }}" class='btn btn-primary'>Alterar Senha</a>
            </div>
            <p>Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.</p>

            <br /><hr>

            <small>Se você tiver problemas ao clicar no botão "Redefinir Senha", copie e cole o URL abaixo em seu navegador da Web:</small>
            <small>{{ $actionUrl }}</small>
        </td>
    </tr>
@endsection
