@extends('example::layouts.master')

@section('content')
    <form method="post" action="{{ action([\Modules\Example\Http\Controllers\ExampleController::class, 'show'], [], false) }}">
    @csrf
        <input name="search" type="text"@if (($search = ($input['search'] ?? null)) !== null) value="{{ $search }}"@endif>
        <input type="submit" value="Search">
    </form>

    @if (!empty($data))
        <form method="post" action="">
        <table>
            <thead>
            <tr>
            <th>Choose</th>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['products'] ?? [] as $item)
            <tr>
                <td><input type="checkbox" name="choose"></td>
                <td>{{ $item['id'] }}</td>
                <td>@if (($image = ($item['image_front_thumb_url'] ?? null)) !== null ) <img src="{{ $image }}"> @endif</td>
                <td>{{ $item['product_name'] }}</td>
                <td>{{ $item['categories'] ?? '' }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <input type="submit" value="Save chosen">
        </form>
    @endif
@endsection
