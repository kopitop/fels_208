@extends('layouts.app')

@section('sidebar')
    @include('layouts.includes.sidebar')
@endsection

@section('content')

<h3><strong>{{ $title }}: </strong>{{ $word->name }}</h3>
<form class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-2 control-label">{{ trans('word.content') }}</label>
        <div class="col-sm-10">
            <p class="form-control-static">{{ $word->content }}</p>
        </div>
    </div>
    @foreach($answers as $answer)
        <div class="form-group">
            <label class="col-sm-2 control-label">{{ trans('word.answer') }}</label>
            <div class="col-sm-10">
                <p class="form-control-static answer">{{ $answer->content }}
                @if($answer->is_correct)
                    <span><strong>This is true</strong></span>
                @endif
                </p>
            </div>
        </div>
    @endforeach
    <div class="form-group">
        <a href="{{ action('Admin\CategoriesController@edit', ['id' => $word->id]) }}" class="btn btn-default">{{ trans('fels.button.edit') }}</a>
    </div>
</form>

@endsection
