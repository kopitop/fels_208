@extends('layouts.app')

@section('content')

{{ $title }}
<hr>
@if ($user)
    <div>
        <img src="{{ $user->avatar ? asset(($user->avatar_url)) : asset(config('fels.default-avatar')) }}" class="avatar">
    </div>
    <label>{{ trans('fels.name') }}: </label> {{ $user->name }}<br>
    <label>{{ trans('fels.email') }}: </label> {{ $user->email }}<br><br>
    @if ($user->isCurrent())
        <a href="{{ action('Web\ProfilesController@edit', ['id' => $user->id]) }}">
            <button class="btn btn-success" type="button">{{ trans('users.update-profile') }}</button>
        </a>
        <a href="{{ action('Web\ProfilesController@editPassword') }}">
            <button class="btn btn-info" type="button">{{ trans('users.change-password') }}</button>
        </a>
    @elseif ($check_followed)
        <a href="{{ action('Web\FollowsController@unfollow', ['id' => $user->id]) }}" class="btn btn-success"
              id="unfollow">
              <strong>{{ trans('users.user-follow.unfollow') }}</strong>
        </a>
        {!! Form::open(['action' => ['Web\FollowsController@unfollow', $user->id], 'method' => 'POST', 'id' => 'unfollow-form']) !!}
        {!! Form::close() !!}
    @else
        <a href="{{ action('Web\FollowsController@follow', ['id' => $user->id]) }}" class="btn btn-success"
              id="follow">
              <strong>{{ trans('users.user-follow.follow') }}</strong>
        </a>
        {!! Form::open(['action' => ['Web\FollowsController@follow', $user->id], 'method' => 'POST', 'id' => 'follow-form']) !!}
        {!! Form::close() !!}
    @endif
@else
    <div class="alert alert-danger">{{ trans('users.not-found') }}</div>
    <br>
    <a href="{{ action('Web\ProfilesController@show', ['id' => Auth::user()->id]) }}" class="btn btn-default">
    <strong>{{ trans('fels.button.back-to-profile') }}</strong></a>
@endif

@endsection
