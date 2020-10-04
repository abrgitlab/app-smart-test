<nav aria-label="Page navigation example">
    <ul class="pagination">
        @if(($input['page']) > 1)
            <li class="page-item"><a class="page-link" href="{{ action([\Modules\Example\Http\Controllers\ExampleController::class, 'show'], [
                            'search' => $input['search'],
                            'page' => $input['page'] - 1,
                        ]) }}">Previous</a></li>
        @endif
        @foreach(\Modules\Example\Services\Paginator::paginate($input['page'], $data['page_size'], $data['count']) as $pages)
            @foreach($pages as $page)
                @if (($input['page']) === $page)
                    <li class="page-item active" aria-current="page">
                        <a class="page-link">{{ $input['page'] }}<span class="sr-only">(current)</span></a>
                    </li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ action([\Modules\Example\Http\Controllers\ExampleController::class, 'show'], [
                                'search' => $input['search'],
                                'page' => $page,
                            ], false) }}">{{ $page }}</a></li>
                @endif
            @endforeach
            @if (!$loop->last)
                <li class="page-item"><a class="page-link">...</a></li>
            @endif
        @endforeach
        @if(($input['page']) < $input['totalPages'])
            <li class="page-item"><a class="page-link" href="{{ action([\Modules\Example\Http\Controllers\ExampleController::class, 'show'], [
                    'search' => $input['search'],
                    'page' => ($input['page']) + 1,
                ]) }}">Next</a></li>
        @endif
    </ul>
</nav>
