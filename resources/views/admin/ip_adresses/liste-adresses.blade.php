@extends('layouts.utilisateur')

@section('content')
    <script src="{{asset('js/fiches/fiche.js')}}"></script>
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
        @include('includes.utilisateur-sidebar')
        <!-- Main content -->
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header page-header-default ">
                    <div class="page-header-content hidden">
                        <div class="page-title">
                            <h4>
                                <i class="icon-files-empty position-left"></i>
                                <span class="text-semibold">Adresses ip</span>
                            </h4>
                        </div>
                        @include('includes.utilisateur-page-header')
                    </div>

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="{{url('/admin/fiches')}}"><i class="icon-home2 position-left"></i> Accueil
                                </a></li>
                            <li class="active">Adresses ip</li>
                        </ul>

                        <ul class="breadcrumb-elements hidden">
                            <li><a href="#"><i class="icon-comment-discussion position-left"></i>Support</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-gear position-left"></i> Settings <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                                    <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                                    <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->

                <!-- Content area -->

                <div class="content">
                    @if(Session::has('message'))
                        <div class="rounded0 alert {{ Session::get('alert-class', 'alert-info') }} alert-styled-left alert-arrow-left alert-bordered">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                        class="sr-only">Close</span></button>
                            <span class="text-semibold"> {{ Session::get('message') }} .</span>
                        </div>
                @endif
                    <!-- Basic datatable -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <button onclick="window.location.href='{{url('/nouvelle-adresse-ip')}}'"
                                        class="rounded0 text-white btn btn-primary btn-xs-custom"><i
                                            class="icon-plus-circle2"></i> Ajouter une adresse ip
                                </button>
                            </h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>


                        <table class="table basic-datatable">
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($adresses as $adress)
                                <tr>
                                    <td>{{$adress->adresse_ip}}</td>
                                    <td>{{$adress->description}}</td>
                                    <td align="center">
                                        <a title="Modifier" href="{{url('/adresses-ip/'.$adress->id.'/modification')}}">
                                            <i class="icon-pencil3"></i>
                                        </a>
                                        <a class="confirm-delete" data-href="{{url('/adresses-ip/'.$adress->id.'/suppression')}}" title="Supprimer"><i class="icon-trash"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /basic datatable -->
                    <!-- Footer -->
                @include('includes.footer')
                <!-- /footer -->
                </div>
                <!-- /content area -->
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->

@endsection



