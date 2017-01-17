@extends('template')
@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="well">
                @if(count($frase) > 0)
                    <h3>{{$frase->frase}}</h3>
                    <small class="text-danger pull-right">{{$frase->autor}}</small>
                @endif
            </div>

        </div>
        <div class="col-md-2" style='border:solid 1px; height:800px'>

        </div>

    </div>

@stop
