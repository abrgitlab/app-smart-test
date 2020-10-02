@extends('example::layouts.master')

@section('content')
    <div class="card">
    <form method="post" class="card-body" action="{{ action([\Modules\Example\Http\Controllers\ExampleController::class, 'show'], [], false) }}">
    @csrf
        <div class="form-group">
            <label for="search">Type words</label>
            <input name="search" class="form-control" id="search" type="text"@if (($search = ($input['search'] ?? null)) !== null) value="{{ $search }}"@endif>
        </div>
        <input type="submit" class="btn btn-primary" value="Search">
    </form>
    </div>
    @if (!empty($data) && $data['count'] > 0)
        <table class="table">
            <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Save</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['products'] ?? [] as $item)
            <tr>
                <td id="id_{{ $item['id'] }}">{{ $item['id'] }}</td>
                <td>@if (($image = ($item['image_front_thumb_url'] ?? null)) !== null ) <img src="{{ $image }}" id="image_{{ $item['id'] }}"> @endif</td>
                <td id="product_name_{{ $item['id'] }}">{{ $item['product_name'] }}</td>
                <td id="categories_{{ $item['id'] }}">{{ $item['categories'] ?? '' }}</td>
                <td><a href="{{ action([\Modules\Example\Http\Controllers\ExampleController::class, 'save'], [], false) }}" class="save" id="{{ $item['id'] }}">Save</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                @if(($input['page'] ?? 1) > 1)
                <li class="page-item"><a class="page-link" href="{{ action([\Modules\Example\Http\Controllers\ExampleController::class, 'show'], [
                            'search' => $input['search'],
                            'page' => $input['page'] - 1,
                        ]) }}">Previous</a></li>
                @endif
                @foreach(\Modules\Example\Services\Paginator::paginate($input['page'] ?? 1, $data['page_size'], $data['count']) as $pages)
                    @foreach($pages as $page)
                        @if (($input['page'] ?? 1) === $page)
                            <li class="page-item active" aria-current="page">
                                <a class="page-link">{{ $input['page'] ?? 1 }}<span class="sr-only">(current)</span></a>
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
                @if(($input['page'] ?? 1) < $input['totalPages'])
                <li class="page-item"><a class="page-link" href="{{ action([\Modules\Example\Http\Controllers\ExampleController::class, 'show'], [
                    'search' => $input['search'],
                    'page' => ($input['page'] ?? 1) + 1,
                ]) }}">Next</a></li>
                @endif
            </ul>
        </nav>
    @elseif(!empty($data) && $data['count'] === 0)
        <div class="card">
            <div class="card-body">
                No results
            </div>
        </div>
    @endif
@endsection
