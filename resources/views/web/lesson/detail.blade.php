@extends('layouts.app')

@section('sidebar')
    @include('layouts.includes.web-sidebar')
@endsection

@section('content')

{{ $title }}
<hr>
<div class="row">
    <div class="col-md-12">
    <p>{{ $examiner->name}}</p>
        <table class="table">
            <tr>
                <td>{{ trans('web/lesson.word') }}</td>
                <td>{{ trans('web/lesson.answer') }}</td>
                <td>{{ trans('web/lesson.true-false') }}</td>
            </tr>
            @foreach ($results as $result)
            <tr>
                <td>{{ $result->word->content }}</td>
                <td>{{ $result->answer->content }}</td>
                <td>{{ trans('web/lesson.' . $result->answer->is_correct) }}</td>
            </tr>
            @endforeach
            <tr>{{ count($score) }} / {{ count($results) }}</tr>
        </table>
    </div>
</div>
@endsection
