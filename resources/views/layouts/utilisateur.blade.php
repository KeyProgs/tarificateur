<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="APP_URL" content="<?php echo "https://" . $_SERVER['SERVER_NAME'].''; ?>">
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
    <link href="{{asset('global-assets/css/plugins/datepicker.css')}}" rel="stylesheet" type="text/css">



    <link href="{{asset('css/main.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset('global-assets/js/plugins/loaders/pace.min.js')}}"></script>
    <script src="{{asset('global-assets/js/core/libraries/jquery.min.js')}}"></script>
    <script src="{{asset('global-assets/js/core/libraries/bootstrap.min.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{asset('global-assets/js/plugins/forms/selects/bootstrap_select.min.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/ui/moment/moment.min.js')}}"></script>

    <script src="{{asset('global-assets/js/plugins/bootstrap-date-picker/bootstrap-datepicker.js')}}"></script>

    <script src="{{asset('global-assets/js/core/libraries/jasny_bootstrap.min.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/notifications/sweet_alert.min.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/forms/wizards/stepy.min.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/forms/validation/validate.min.js')}}"></script>

    <!-- tree js-->
    <script src="{{asset('global-assets/js/plugins/treeview/logger.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/treeview/treeview.js')}}"></script>
    <!--/ tree js-->

    @if(request()->is('templates*') || request()->is('new-mail*') )
        <script src="{{asset('global-assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
        <script src="{{asset('global-assets/js/plugins/editors/wysihtml5/wysihtml5.min.js')}}"></script>
        <script src="{{asset('global-assets/js/plugins/editors/wysihtml5/toolbar.js')}}"></script>
        <script src="{{asset('global-assets/js/plugins/editors/wysihtml5/parsers.js')}}"></script>
        <script src="{{asset('global-assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js')}}"></script>
        <script src="{{asset('global-assets/js/demo_pages/editor_wysihtml5.js')}}"></script>
    @endif

    <script src="{{asset('global-assets/js/plugins/editors/summernote/summernote.min.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/visualization/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('js/limitless.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

    <script src="{{asset('global-assets/js/plugins/uploaders/fileinput/plugins/purify.min.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/uploaders/fileinput/fileinput.min.js')}}"></script>

    <script src="{{asset('global-assets/js/demo_pages/uploader_bootstrap.js')}}"></script>
    <script src="{{asset('global-assets/js/demo_pages/datatables_basic.js')}}"></script>
    <script src="{{asset('global-assets/js/demo_pages/form_bootstrap_select.js')}}"></script>
    <script src="{{asset('global-assets/js/demo_pages/wizard_stepy.js')}}"></script>
    <script src="{{asset('global-assets/js/demo_pages/charts/echarts/pies_donuts.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->
</head>

<body >
<!-- Main navbar -->
<div class="navbar navbar-inverse bg-perfectassur navbar-static-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('/img/acs.jpg')}}" alt=""></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li>
                <a class="sidebar-control sidebar-main-toggle   "><i class="icon-paragraph-justify3"></i></a>
            </li>

            <li class="dropdown ">


            @include('includes.news')
            </li>
            <li>

            </li>
        </ul>
        <div class="input-group col-md-4">
            <input type="text" id="search-text-all" class="form-control"
                   placeholder="Chercher : Code /Nom /Email /Tél /Adresse /commentaire   "
                   style="color: white;    font-style: italic;">
        </div>
        <div class="navbar-right" style="margin-top: -30px;">
            <p class="navbar-text">Bonjour, {{Auth::user()->prenom}}</p>
            <p class="navbar-text"><span class="label bg-success-400">Online</span></p>

            <ul class="nav navbar-nav">
                <li class="dropdown ">
                @include('includes.activity')
                </li>

                <li class="dropdown ">
                <!--include('includes.messages')-->
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /main navbar -->
@yield('content')






</body>
</html>
