@if ($paginator->hasPages())
    <div class="col-12">
        <ul class="pagination pl-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
                @php
                    $query = parse_url("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], PHP_URL_QUERY);
                    $query = preg_replace("/page=[0-9]&/", "", $query);
                @endphp
                <li class="page-item"><a class="btn-petfy-paginacion page-link" href="{{ $paginator->previousPageUrl()."&".$query }}"
                                         rel="prev">&laquo;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-item page-link ">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item"><span class="page-link btn-petfy-paginacion-active">{{ $page }}</span></li>
                        @else
                            @php
                            $query = parse_url("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], PHP_URL_QUERY);
                            $query = preg_replace("/page=[0-9]&/", "", $query);
                            @endphp
                            <li class="page-item"><a class="page-link btn-petfy-paginacion" href="{{  $url."&".$query }}">{{ $page }}</a></li>

                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                @php
                    $query = parse_url("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], PHP_URL_QUERY);
                    $query = preg_replace("/page=[0-9]&/", "", $query);
                @endphp
                <li class="page-item"><a class="page-link btn-petfy-paginacion" href="{{ $paginator->nextPageUrl()."&".$query }}" rel="next">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled"><span class="page-item page-link">&raquo;</span></li>
            @endif
        </ul>
    </div>
@endif
