@extends('layouts.app')

@section('sidebar')
    @include('layouts.includes.web-sidebar')
@endsection

@section('content')

{{ $title }}
<hr>

@foreach($categories as $category)

<div class="row category-intro">
    <div class="col-md-4">
        <img class="img-responsive" src="{{ Storage::url($category->photo) }}" alt="">
    </div>
    <div class="col-md-8">
        <p>{{ $category->description }}</p>
        @foreach ($category->words as $word)
        <span>{{ $word->content }}</span>
        @endforeach
        <a href="{{ action('Web\LessonsController@doLesson', ['categori_id' => $category->id]) }}" class="btn btn-default">{{ trans('fels.button.learn') }}</a>
    </div>
</div>

@endforeach

@endsection
