<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- DATA TABLES CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.15/r-2.1.1/datatables.min.css"/>

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('/css/open-iconic-bootstrap.css') }}">

        <!-- bootstrap-select CSS -->
        <link rel="stylesheet" href="{{ asset('/css/bootstrap-select.min.css') }}">

        <!-- PACE CSS -->
        <link href="{{ asset('/css/pace/theme.css') }}" rel="stylesheet" />

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
            <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>

                    <div class="col-md-10">
                        @if(!\Illuminate\Support\Facades\Auth::guest())
                            @include('searchbar')
                        @endif
                    </div>

                    <div class="col-md-1"></div>
                </div>

                <div class="row">
                    <div class="col-md-1"></div>

                    <div class="col-md-2">
                        @if(!\Illuminate\Support\Facades\Auth::guest())
                            @include('left-sidebar')

                            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                                @include('admin-sidebar')
                            @endif
                        @endif
                    </div>

                    <div class="col-md-8">
                        @if (Session::has('message'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                                {{ Session::get('message') }}
                            </div>
                        @endif
                        @if (isset($errors) && $errors->any() && false)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @yield('content')
                    </div>

                    <div class="col-md-1"></div>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>

                    <div class="col-md-8">
                        @yield('login')
                    </div>

                    <div class="col-md-2"></div>
                </div>
            </div>

            <!-- Modal -->
            <div class="fixed-top modal fade" id="notification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body alert-info" role="alert">
                            <div class="row">
                                <div id="pusher-message" class="col-md-12"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('/js/app.js') }}"></script>

        <!-- bootstrap-select js -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

        <!-- tinyMCE -->
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=pe82xsff0nrqjdu3z6pb4saczh8x6q4oyeiru1sp80lj1oe4"></script>

        <!-- DATA TABLE JS -->
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.15/r-2.1.1/datatables.min.js"></script>

        <!-- PACE.JS -->
        <script src="{{ asset('/js/pace/pace.js') }}"></script>

        <!-- Custom JS -->
        <script src="{{ asset('/js/custom.js') }}"></script>
    </body>
</html>
