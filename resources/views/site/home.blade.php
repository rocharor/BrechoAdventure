@extends('template')
@section('content')
<div class="well">
    @if(count($frase) > 0)
        <h3>{{$frase->frase}}</h3>
        <small class="text-danger pull-right">{{$frase->autor}}</small>
    @endif
</div>
@stop
