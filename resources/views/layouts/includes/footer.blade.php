<footer class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="logo">
                        <p>{{ trans('fels.framgia') }}</p>
                        <p class="text-center">{{ config('app.name') }}</p>
                    </div>
                    <div class="copyright">
                        <ul>
                            <li>{{ trans('fels.copyright') }}</li>
                            <li>{{ trans('fels.license') }}</li>
                            <li>{{ config('app.company-name') }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <img class="social-logo" src="{{ asset('images/facebook.png') }}" alt="">
                    <img class="social-logo" src="{{ asset('images/twitter.png') }}" alt="">
                    <img class="social-logo" src="{{ asset('images/google.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</footer>
