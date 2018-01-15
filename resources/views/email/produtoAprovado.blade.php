@extends('email/template')
@section('content')
    <tr>
        <td class="corpoEmail">
            <h2>Olá {{ $name }}</h2>
            <p>Parabéns seu produto foi aprovado.</p><br>
            <hr>
            <p><b>Titulo:</b> {{ $title }}</p>
        </td>
    </tr>
@endsection
