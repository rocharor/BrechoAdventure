<!--PAGINAÇÃO-->
<nav align='center'>
  <ul class="pagination">
     <li>
         @if($pg == 1)
            <span aria-label="Previous"><span aria-hidden="true">&laquo;</span></span>
         @else
            <span><a href="{{$link}}{{ $pg - 1 }}" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
         @endif
    </li>

    @for($i = 1; $i <= $numberPages; $i++)
        @if($i == $pg)
            <li class="active"><a>{{ $i }}</a></li>
        @else
            <li><a href="{{$link}}{{ $i }}">{{ $i }}</a></li>
        @endif
    @endfor
     <li>
         @if($pg == $numberPages)
            <span aria-label="Previous"><span aria-hidden="true">&raquo;</span></span>
         @else
            <a href="{{$link}}{{ $pg + 1 }}" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
         @endif
    </li>
  </ul>
</nav>
