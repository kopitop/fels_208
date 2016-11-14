@extends('layouts.app')

@section('sidebar')
    @include('layouts.includes.sidebar')
@endsection

@section('content')

@if (session()->has('status'))
    <div class="alert alert-info">
        <p>{{ session('status') }}</p>
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success">
        <p>{{ session('success') }}</p>
    </div>
@endif

<h3><strong>{{ $title }}: </strong>{{ trans('fels.list') }}</h3>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<hr>

@if($words)
<table class="table table-striped">
    <tr>
        <td>{{ trans('fels.id') }}</td>
        <td>{{ trans('word.content') }}</td>
        <td>{{ trans('word.category') }}</td>
        <td>{{ trans('word.action') }}</td>
    </tr>
    @foreach ($words as $word)
    <tr>
        <td>{{ $word->id }}</td>
        <td><a href="{{ action('Admin\WordsController@show', ['id' => $word->id]) }}">{{ $word->content }}</a></td>
        <td><a href="{{ action('Admin\CategoriesController@show', ['id' => $word->category->id]) }}">{{ $word->category->name }}</a></td>
        <td>
            <a href="{{ action('Admin\CategoriesController@edit', ['id' => $word->id]) }}" class="btn btn-default">{{ trans('fels.button.edit') }}</a>
            {!! Form::open(['route' => ['word.destroy', $word->id], 'method' => 'delete']) !!}
                <button onclick="return confirm('{{ trans('word.delete.confirm') }}')" type="submit" class="btn btn-default">{{ trans('fels.button.delete') }}</button>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</table>
{{ $words->links() }}
@else
    <div class="alert">
        <p>{{ trans('fels.status.nothing-to-show') }}</p>
    </div>
@endif

@endsection
