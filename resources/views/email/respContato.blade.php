@extends('email/template')
@section('content')
    <tr>
        <td class="corpoEmail">
            <h2>Olá {{ $name }}</h2>
            <p>{{ $reply }}</p><br>
            <hr>
            <p><b>Sua mensagem:</b></p>
            <p>{{ htmlspecialchars($mensage) }}</p>
        </td>
    </tr>
@endsection
