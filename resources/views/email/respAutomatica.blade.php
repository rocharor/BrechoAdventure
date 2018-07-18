@extends('email/template')
@section('content')
    <tr>
        <td class="corpoEmail">
            <h2>Olá {{ $name }}</h2>
            <p>Recebemos sua mensagem e retornaremos o mais rápido possivel.</p><br>
            <hr>
            <p><b>Assunto:</b> {{ $type }}</p>
            <p><b>Mensagem:</b> {{ $mensage }}</p>
        </td>
    </tr>
@endsection
