@extends('layouts.app')

@section('sidebar')
    @include('layouts.includes.web-sidebar')
@endsection

@section('content')

{{ $title }}
<hr>
<div class="row">
    <div class="col-md-12">
    {!! Form::open(['url' => route('lesson.store'), 'method' => 'post']) !!}
    @php $i = 1 @endphp
    @foreach ($questions as $question)

        <h3>{{ $i }} | {{ $question['word']->content }}</h3>
        {!! Form::hidden('results[' . $i . '][word]', $question['word']->id); !!}
        @foreach ($question['answers'] as $answer)
        <div class="radio">
          <label>
            {!! Form::radio('results[' . $i . '][answer]', $answer->id,  ['class' => 'form-control']); !!}
            {{ $answer->content }}
          </label>
        </div>
        @endforeach
    
    @php $i++ @endphp
    @endforeach
    {!! Form::submit(trans('fels.button.done')); !!}
    {!! Form::close() !!}
    </div>
</div>
@endsection
