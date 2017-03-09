<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- bootstrap-select CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel =<?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <span class="navbar-brand">DragonsData</span>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @if(!Auth::guest())
                        @include('sidebar')
                    @endif
                </div>

                <div class="col-md-9">
                    @if (Session::has('message'))
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            {{ Session::get('message') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @yield('login')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/custom.js') }}"></script>

    <!-- bootstrap-select js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>

    <!-- tinyMCE -->
    <script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script>tinymce.init({selector: 'textarea#description', themes: "modern"});</script>
</body>
</html>
