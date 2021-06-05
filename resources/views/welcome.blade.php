<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{asset('global-assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/core.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('global-assets/css/plugins/datepicker.css')}}" rel="stylesheet" type="text/css">


    <!-- Core JS files -->
    <script src="{{asset('global-assets/js/plugins/loaders/pace.min.js')}}"></script>
    <script src="{{asset('global-assets/js/core/libraries/jquery.min.js')}}"></script>
    <script src="{{asset('global-assets/js/core/libraries/bootstrap.min.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/loaders/blockui.min.js')}}"></script>


    <title>{{env('APP_NAME')}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (strpos(request(), 'espace-client/connexion') !== false)
        <div class="top-right links sucess">
            @if(session()->has('client'))
                <a href="{{route('home.client')}}">Accueil</a>
                <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                            class="icon-switch2"></i> <span>Déconnexion</span></a>
                <form id="logout-form" action="{{route('logout.client')}}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Connexion
                </button>
            @endif
        </div>
    @else
        @if (Route::has('login'))
            <div class="top-right links sucess">
                @auth
                    <a href="{{ asset('/fiches/etat/1') }}">Agent malin</a>
                    <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                       class="legitRipple"><i class="icon-switch2"></i> <span>Déconnexion</span></a>
                    <form id="logout-form" action="{{@route('logout')}}" method="POST" style="display: none;">
                        @csrf
                    </form>

                @else
                <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Connexion
                    </button>
                <!--<  <a  class="modal_login_launcher" href="#">..::CConnexion::..</a>
                        <a class="modal-connexion-launch" href="{{ route('login') }}">..::Connexion::..</a>
                       a href="{{ route('register') }}">Nouvelle Inscription </a>-->
                @endauth
            </div>
        @endif
    @endif


    <div class="content">
        <div class="title m-b-md">
            <img src="{{asset('/img/ACSASSURANCEONLINE.png')}}" alt="ACS ASSURANCE Tarificateur"/>

            <br>
            ACS CRM
        </div>

        <div class="links">
            <a href="#">Tarification</a>
            <a href="#">Gstion contact</a>
            <a href="#">Statistiques</a>
            <a href="#">Base de connaissance Assurance</a>

        </div>
    </div>
</div>

<!-- Connexion paiement-->
<div id="modal_connexion" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false"
     style="z-index: 999999;">
</div>

<div>
    @include('auth.connexion')
</div>
</body>

<script>
    //pour lancer le modal de paiement
    $('.modal_login_launcher').on('click', function () {
        $.ajax({
            url: "/myconnexion",
            type: "GET",
            cache: false,
            success: function (data) {
                $('#modal_connexion').html(data);
                $('#modal_connexion').modal('show');
            }
        });
    });
</script>
</html>
