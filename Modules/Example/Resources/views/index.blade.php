@extends('example::layouts.master')

@section('content')
    <form method="post" action="{{ action([\Modules\Example\Http\Controllers\ExampleController::class, 'show'], [], false) }}">
    @csrf
        <div class="form-group">
            <label for="search">Type words</label>
            <input name="search" class="form-control" id="search" type="text"@if (($search = ($input['search'] ?? null)) !== null) value="{{ $search }}"@endif>
        </div>
        <input type="submit" class="btn btn-primary" value="Search">
    </form>
    @if (!empty($data))
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
    @endif
@endsection
