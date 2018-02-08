<ol class="breadcrumb" style="font-size:11px">
    <li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
    @foreach($breadCrumb as $value)
        @if(is_array($value))
            <li><a href="{{ Route($value['link']) }}">{{ $value['name'] }}</a></li>
        @else
            <li class="active">{{ $value }}</li>
        @endif
    @endforeach
</ol>
