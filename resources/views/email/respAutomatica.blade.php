@extends('email\template')
@section('content')
    <tr>
        <td class="corpoEmail">
            <h2>Olá {{$nome}}</h2>
            <p>Recebemos seu e-mail e retornaremos o mais rápido possivel.</p><br>
        </td>
    </tr>
@endsection
