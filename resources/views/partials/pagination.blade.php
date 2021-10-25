<table border='1'>
    <tr>
        <td>
            @if($from > 0)
                @if($now > 2)
                    <a href="{{route(Route::current()->getName())}}?page=1&filter={{$filter}}">first [{{1}}]>> </a>
                @endif
                <a href="{{route(Route::current()->getName())}}?page={{$from}}&filter={{$filter}}"><< prev [{{$from}}]</a>
            @endif
        </td>
        <td><li style="display: inline; ">now [{{$now}}]</li></td>
        <td>
            @if($to <= $last_page)
                <a href="{{route(Route::current()->getName())}}?page={{$to}}&filter={{$filter}}">next [{{$to}}]>> </a>
                @if($to <= $last_page - 1)
                    <a href="{{route(Route::current()->getName())}}?page={{$last_page}}&filter={{$filter}}">last [{{$last_page}}]>> </a>
                @endif
            @endif
        </td>
    </tr>
<table>
