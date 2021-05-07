<div>
    / {{ \Illuminate\Support\Facades\Request::segment(1) }}
    @if(!empty(\Illuminate\Support\Facades\Request::segment(2)))
        / {{ \Illuminate\Support\Facades\Request::segment(2) }}
    @endif
    @if(!empty(\Illuminate\Support\Facades\Request::segment(3)))
        / {{ \Illuminate\Support\Facades\Request::segment(3) }}
    @endif
</div>
