@extends('layouts.app')

@section('content')

{{ $title }}
<hr>
@if($user)
    <img src="{{ asset($user->avatar) }}" class="avatar" alt=""><br><br>
    <label>{{ trans('fels.name') }}: </label> {{ $user->name }}<br>
    <label>{{ trans('fels.email') }}: </label> {{ $user->email }}<br><br>
    @if($user->isCurrent())
        <a href="{{ action('User\ProfilesController@edit', ['id' => $user->id]) }}">
            <button class="btn btn-success" type="button">{{ trans('users.update-profile') }}</button>
        </a>
        <a href="{{ action('User\ProfilesController@editPassword') }}">
            <button class="btn btn-info" type="button">{{ trans('users.change-password') }}</button>
        </a>
    @endif
@else
    {{ trans('users.not-found') }}
    <br>
    <input type="button" class="btn btn-default" onclick="history.go(-1);" value="{{ trans('users.back') }}">
@endif
@endsection
