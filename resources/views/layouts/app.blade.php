<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    @include('layouts.includes.head')
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
        @include('layouts.includes.banner')
        <!-- end of banner -->

        <div class="subview container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="sidebar col-md-3">
                            @yield('sidebar')
                        </div>
                        <div class="content col-md-9">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of content -->

        @include('layouts.includes.footer')
        <!-- end of footer -->

        @include('layouts.includes.fullscreen-menu')
        <!-- end of fullscreen-menu -->

    
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
