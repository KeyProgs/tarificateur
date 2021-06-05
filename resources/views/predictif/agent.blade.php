@extends('layouts.utilisateur')

@section('content')
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
        @include('includes.utilisateur-sidebar')
        <!-- Main content -->
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header page-header-default">

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{url('/fiches/etat/1')}}"><i class="icon-home2 position-left"
                                                                       style="font-size: 15px;"></i> Accueil
                                </a>
                            </li>
                            <li class="active">Agent Predictif {{$local_server}}</li>
                        </ul>

                        <ul class="breadcrumb-elements">
                            <li>
                                <input type="search" class="form-control" placeholder="N° Télephone">
                            </li>
                            <li>
                                <a href="#" style="     "><i class="icon-phone2 position-left"></i>Appeler</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                   style="color: #065809; font-weight: bold;">
                                    <i class="icon-alarm position-left"></i> Rappels <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{url('/fiches/etat/21/-1')}}">
                                            <span><span class="badge bg-teal-400 pull-right"></span> </span>
                                            Rappels en retard
                                        </a>
                                    </li>
                                    <li><a href="{{url('/fiches/etat/21/0')}}">
                                            <span><span class="badge bg-teal-400 pull-right"></span> </span>
                                            Rapples
                                            du jour</a></li>
                                    <li><a href="{{url('/fiches/etat/21/1')}}">
                                            <span><span class="badge bg-teal-400 pull-right"></span> </span>
                                            Rappeles programmés</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{url('/fiches/etat/21')}}">
                                            Tout Les Rappels</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->

                <!-- Content area -->

                Connécté au serveur local {{$nom_equipe}}
                <div class="content">

                    <iframe src="http://{{$local_server}}/agent/agent_2.php" height="800" width="100%"></iframe>


                    {{--<object data="https://{{$local_server}}/agent/agent_2.php" width="100%" height="800">--}}
                        {{--<embed src="https://{{$local_server}}/agent/agent_2.php" width="100%" height="800"></embed>--}}
                        {{--ACS: Predictif Calls--}}
                    {{--</object>--}}
                </div>
                <!-- /detached content -->
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

    <script type="text/javascript">
        $(document).ready(function () {
            $(".btn-send-mail").on('click', function () {
                $('#mailForm').attr('action', '{{url('/mail/nouveau')}}');
                $('#mailForm').submit();
            });
            $(".btn-save-mail").on('click', function () {
                $('#mailForm').attr('action', '{{url('/mail/enregister-mail')}}');
                $('#mailForm').submit();
            });
        });
    </script>
@endsection




