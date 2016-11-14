@extends('layouts.app')

@section('sidebar')
    @include('layouts.includes.sidebar')
@endsection

@section('content')

@if (session()->has('status'))
    <div class="alert alert-success">
        <p>{{ session('status') }}</p>
    </div>
@endif

<h3><strong>{{ $title }}: </strong>{{ trans('fels.create') }}</h3>
<hr>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{!! Form::open(['url' => route('word.update', ['id' => $word->id]), 'method' => 'put']) !!}
    <div class="form-group">
        {!! Form::label('content', trans('word.content')); !!}
        {!! Form::text('content', $word->content, ['class' => 'form-control']); !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('category_id', trans('word.category')); !!}
        <select class="form-control" name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if ($word->category_id == $category->id) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group" id="answers">
    <!-- Render form and populate value after redirect -->
        @if (count($errors) > 0)
            @php $oldAnswer = old('answer') @endphp
            @foreach ($oldAnswer as $key => $value) 
                <div class="answer-container">
                    {!! Form::label('answer', trans('word.answer')); !!}
                    <input name="answer[{{ $key }}]" type="text" class="form-control" value="{{ $value }}">
                    <span>{{ trans('word.is-correct') }}</span>
                    <input type="checkbox" name="is_correct[{{ $key }}]" @if (old('is_correct.'.$key) == 'on') checked @endif>
                    @if ($key != 0)
                    <a class="btn btn-default remove-answer" href="Javascript:;">' + remove + '</a>
                @endif
                </div>
            @endforeach
        @else
        <!-- Render old answers -->
        @php $i = 0 @endphp
        @foreach ($answers as $answer)
            <div class="answer-container">
                {!! Form::label('answer', trans('word.answer')); !!}
                {!! Form::text('answer[' . $i . ']', $answer->content, ['class' => 'form-control']); !!}
                <span>{{ trans('word.is-correct') }}</span>
                @if ($answer->is_correct == 1)
                {!! Form::checkbox('is_correct[' . $i . ']', 'on', true ); !!}
                @else
                {!! Form::checkbox('is_correct[' . $i . ']', 'on' ); !!}
                @endif
                <a class="btn btn-default remove-answer" href="Javascript:;">{{ trans('word.remove') }}</a>
            </div>
        @php $i++ @endphp
        @endforeach
        @endif
    </div>

    <div class="form-group">
        {!! Form::submit(trans('fels.button.edit'), ['class' => 'btn btn-default']); !!}
        <a href="javascript:;" class="btn btn-default" id="addAnswer">{{ trans('word.add-answer') }}</a>
    </div>
{!! Form::close() !!}
<script>
    var label = "{{ trans('word.answer') }}";
    var remove = "{{ trans('word.remove') }}";
    var isCorrect = "{{ trans('word.is-correct') }}";
</script>
@endsection
