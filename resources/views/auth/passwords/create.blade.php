@extends('layouts.app')

@section('content')
<div class="panel-heading">{{ trans('fels.create-password') }}</div>

<div class="panel-body">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('register') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="register_name">{{ trans('fels.name') }}</label>
            <input id="register_name" name="register_name" type="text" class="form-control" placeholder="Name">
            @if ($errors->has('register_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('register_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="register_email">{{ trans('fels.email') }}</label>
            <input id="register_email" type="email" name="register_email" class="form-control" value="{{ $socialEmail }}" placeholder="Email" disabled>
            @if ($errors->has('register_email'))
                <span class="help-block">
                    <strong>{{ $errors->first('register_email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="register_password">{{ trans('fels.password') }}</label>
            <input type="password" id="register_password" class="form-control" name="register_password" placeholder="Password">
            @if ($errors->has('register_password'))
                <span class="help-block">
                    <strong>{{ $errors->first('register_password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="register_cfpassword">{{ trans('fels.confirm-password') }}</label>
            <input type="password" id="register_cfpassword" class="form-control" name="register_password_confirmation" placeholder="Password">
        </div>
        <div class="button-action text-center">
            <button type="submit" class="btn btn-default" form="sign-up-form">{{ trans('fels.register') }}</button>
            <button type="reset" class="btn btn-default">{{ trans('fels.reset') }}</button>
            <a href="javascript:;" class="back-to-login btn btn-default">{{ trans('fels.back-to-login') }}</a>
        </div>
    </form>
</div>
@endsection
