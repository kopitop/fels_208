@extends('layouts.app')

@section('sidebar')
    @include('layouts.includes.web-sidebar')
@endsection

@section('content')

<div class="row">

    <div class="col-md-offset-4 col-md-4">
        {!! Form::open(['url' => route('wordlist'), 'method' => 'get']) !!}
            <div class="form-group">
                <div class="input-group search">
                    {!! Form::text('keyword', $keyword ? $keyword : '', ['class' => 'form-control']) !!}
                    <div class="input-group-addon">
                        {!! Form::button('<i class="fa fa-search" aria-hidden="true"></i>', ['class' => 'btn btn-default', 'type' => 'submit']) !!}
                    </div>
                </div>
            </div> <!-- end of searchbar -->
        {!! Form::close() !!}
        <div class="form-group">
            {!! Form::open(['url' => route('download'), 'method' => 'post']) !!}
                {!! Form::hidden('keyword-download') !!}
                {!! Form::submit(trans('fels.button.download')) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="row wordlist">
    @foreach ($words as $word)
    <div class="col-md-6">
        <p>{{ $word->content }}</p>
    </div>
    @endforeach
    {{ $words->links() }}

</div>

@endsection
