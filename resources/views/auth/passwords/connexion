<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="APP_URL" content="{{env('APP_URL')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME')}}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{asset('global-assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/core.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <!-- Main stylesheets -->
    <link href="{{asset('css/main.css')}}" rel="stylesheet" type="text/css">
    <!-- /main stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset('global-assets/js/plugins/loaders/pace.min.js')}}"></script>
    <script src="{{asset('global-assets/js/core/libraries/jquery.min.js')}}"></script>
    <script src="{{asset('global-assets/js/core/libraries/bootstrap.min.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{asset('global-assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

    <script src="{{asset('global-assets/js/demo_pages/login.js')}}"></script>

    <script src="{{asset('global-assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container">

<!-- Main navbar -->
<div class="navbar navbar-inverse bg-grey-600 bg-indigo navbar-static-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html"><img src="/img/acs.png" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="#">
                    <i class="icon-display4"></i> <span
                            class="visible-xs-inline-block position-right">Visiter le site</span>
                </a>
            </li>

            <li>
                <a href="mailto:supporttechnique@acsassurance.com?Subject=Contact%20acsAssurance" title="Contacter l'admin">
                    <i class="icon-user-tie"></i> <span
                            class="visible-xs-inline-block position-right"> Contactez admin</span>
                </a>
            </li>


        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Advanced login -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-lock"></i></div>
                            <h5 class="content-group">Connexion Workspace
                                <small class="display-block">Vos identifiants
                                </small>
                            </h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <!--<input type="text" class="form-control" placeholder="Username">-->
                            <input id="email" type="text"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ old('email') }}" autofocus placeholder="Email">

                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback error-msg text-danger">
                                        <strong>- {{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <!--<input type="password" class="form-control" placeholder="Password">-->
                            <input id="password" name="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   placeholder="Mot de passe">

                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback error-msg text-danger">
                                        <strong>- {{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group login-options">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="checkbox-inline">
                                        <input class="styled" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Rester connecté
                                    </label>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <!--<a href="login_password_recover.html">Forgot password?</a>-->
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn bg-info btn-block">
                                {{ __('Ouvrire la session') }} <i class="icon-unlocked2 position-right"></i>
                            </button>
                        </div>


                    </div>
                </form>
                <!-- /advanced login -->


                <!-- Footer -->
            @include('includes.footer')
                <script>
                    $("#footer").addClass("text-center");
                </script>

                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
