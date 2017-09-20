<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.rawgit.com/infostreams/bootstrap-select/fd227d46de2afed300d97fd0962de80fa71afb3b/dist/css/bootstrap-select.min.css" />
        <link rel="stylesheet" href="{{ asset('/css/open-iconic-bootstrap.css') }}">

        {!! Theme::css('css/theme.css') !!}
    </head>

    <body>
        <div id="app">
            <div class="row navbar-dark header">
                <div class="col-md-8 ml-md-auto">
                    @include('layout.nav')
                </div>

                <!-- Keep last col empty -->
                <div class="ml-md-auto"></div>
            </div>

            <main class="row">
                <div class="col-md-8 ml-md-auto">
                    <div class="row">
                        <div class="col">
                            @yield('content')
                        </div>
                    </div>
                </div>

                <!-- Keep last col empty -->
                <div class="ml-md-auto"></div>
            </main>

            <footer class="row">
                <div class="footer col-md-8 ml-md-auto">
                    @include('layout.footer')
                </div>

                <!-- Keep last col empty -->
                <div class="ml-md-auto"></div>
            </footer>
        </div>

        <!-- Scripts -->
        <script>
            window.Laravel =<?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>


        <script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        <script src="https://cdn.rawgit.com/infostreams/bootstrap-select/fd227d46de2afed300d97fd0962de80fa71afb3b/dist/js/bootstrap-select.min.js"></script>

        {!! Theme::js('js/theme.js') !!}
    </body>
</html>