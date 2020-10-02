@extends('example::layouts.master')

@section('content')
    {{ Form::open(array('url' => 'example')) }}
    @csrf
    {{ Form::text('search') }}
    {{ Form::submit('Search') }}
    {{ Form::close() }}
@endsection
