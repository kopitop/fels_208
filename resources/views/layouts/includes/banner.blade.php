<div class="banner container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="header clearfix">
                        <div class="left pull-left text-center">
                            <a class="logo" href="/">{{ trans('fels.framgia') }}</a>
                            <p class="text-center">{{ config('app.name') }}</p>
                        </div>
                        <div class="right pull-right">
                            @if (Auth::guest())
                                <div class="user">
                                    <p>{{ trans('fels.welcome') }}</p>
                                </div>
                            @else
                                <ul class="logged">
                                    <li>{{ trans('fels.hello') }} <strong>{{ Auth::user()->name }}</strong>
                                        <ul class="card-1">
                                            <li>
                                                <a href="{{ url('/logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                <strong>{{ trans('fels.logout') }}</strong>
                                                </a>

                                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            @endif
                            <div class="modal fade login-modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">{{ trans('fels.invite-register') }}</h4>
                                        </div>
                                        <div class="modal-body login">
                                            <div class="col-md-6 left">
                                                <div class="social-container">
                                                    <div class="fb-icon-bg text-center">
                                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="fb-bg"></div>
                                                    <div class="twi-icon-bg text-center">
                                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="twi-bg"></div>
                                                    <div class="g-icon-bg text-center">
                                                        <i class="fa fa-google" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="g-bg"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 right">
                                                <form action="{{ url('/login') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label for="login_email">{{ trans('fels.email') }}</label>
                                                        <input type="email" class="form-control" id="login_email" name="email" placeholder="Email" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="login_password">{{ trans('fels.password') }}</label>
                                                        <input type="password" class="form-control" id="login_password" name="password" placeholder="Password"  required>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                        <input type="checkbox"> {{ trans('fels.remember') }}
                                                        </label>
                                                    </div>
                                                    <button type="submit" class="btn btn-default">{{ trans('fels.sign-in') }}</button>
                                                    <a href="javascript:;" class="btn btn-default sign-up-button">{{ trans('fels.sign-up') }}</a>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-body sign-up">
                                            <form>
                                                <div class="col-md-6 left">
                                                    <div class="form-group">
                                                        <label for="register_name">{{ trans('fels.name') }}</label>
                                                        <input id="register_name" type="text" class="form-control" placeholder="Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="register_email">{{ trans('fels.email') }}</label>
                                                        <input id="register_email" type="email" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 right">
                                                    <div class="form-group">
                                                        <label for="register_password">{{ trans('fels.password') }}</label>
                                                        <input type="password" id="register_password" class="form-control" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="register_cfpassword">{{ trans('fels.confirm-password') }}</label>
                                                        <input type="password" id="register_cfpassword" class="form-control" placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="button-action text-center">
                                                    <button type="submit" class="btn btn-default">{{ trans('fels.register') }}</button>
                                                    <button type="reset" class="btn btn-default">{{ trans('fels.reset') }}</button>
                                                    <a href="javascript:;" class="back-to-login btn btn-default">{{ trans('fels.back-to-login') }}</a>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <div class="menu-bar">
                                <div class="bar1"></div>
                                <div class="bar2"></div>
                                <div class="bar3"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end of header -->
                </div>
            </div>
        </div>
    </div>
</div>
