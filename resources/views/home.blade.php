@extends('layouts.app')

@section('content')

@if (session()->has('status'))
    <div class="alert alert-success">
        <p>{{ session('status') }}</p>
    </div>
@endif

{{ trans('fels.welcome') }}

<p><a href="{{ action('Web\CategoriesController@index') }}">{{ trans('category.click-to-view') }}</a></p>

@endsection
