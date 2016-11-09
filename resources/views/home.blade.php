@extends('layouts.app')

@section('content')

@if (session()->has('status'))
    <div class="alert alert-success">
        <p>{{ session('status') }}</p>
    </div>
@endif
{{ trans('fels.welcome') }}

@endsection
