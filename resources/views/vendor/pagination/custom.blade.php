@if ($paginator->hasPages())
<div class="row justify-content-center mt-5">
    <div class="col-lg-7  text-center">
        <nav class="pagination py-2 d-inline-block">
            <div class="nav-links">
                @if ($paginator->onFirstPage())
                    <a class="page-numbers" href="#"><i class="icofont-thin-double-left"></i></a>
                @else
                    <a class="page-numbers" href="{{ $paginator->previousPageUrl() }}"><i class="icofont-thin-double-left"></i></a>
                @endif

                @foreach ($elements as $element)
       
                    @if (is_string($element))
                        <span aria-current="page" class="page-numbers current">{{ $element }}</span>
                    @endif


                
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page" class="page-numbers current">{{ $page }}</span>
                            @else
                                <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach


                @if ($paginator->hasMorePages())
                    <a class="page-numbers" href="{{ $paginator->nextPageUrl() }}"><i class="icofont-thin-double-right"></i></a>
                @else
                    <a class="page-numbers" href="#"><i class="icofont-thin-double-right"></i></a>
                @endif
            </div>
        </nav>
    </div>
</div>
@endif 