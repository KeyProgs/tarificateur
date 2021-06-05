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
                                </a></li>
                            <li class="active">Liste des Email</li>
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
                                            Rapples du jour</a></li>
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
                <div class="content">


                    <!-- Multiple lines -->
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h6 class="panel-title">Ma boîte de réception</h6>

                            <div class="heading-elements not-collapsible">
                                <span class="label bg-blue heading-text">259 new today</span>
                            </div>
                        </div>

                        <div class="panel-toolbar panel-toolbar-inbox">
                            <div class="navbar navbar-default">
                                <ul class="nav navbar-nav visible-xs-block no-border">
                                    <li>
                                        <a class="text-center collapsed" data-toggle="collapse"
                                           data-target="#inbox-toolbar-toggle-multiple">
                                            <i class="icon-circle-down2"></i>
                                        </a>
                                    </li>
                                </ul>

                                <div class="navbar-collapse collapse" id="inbox-toolbar-toggle-multiple">
                                    <div class="btn-group navbar-btn">
                                        <button type="button" class="btn btn-default btn-icon btn-checkbox-all">
                                            <input type="checkbox" class="styled">
                                        </button>

                                        <button type="button" class="btn btn-default btn-icon dropdown-toggle"
                                                data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li><a href="#">Select all</a></li>
                                            <li><a href="#">Select read</a></li>
                                            <li><a href="#">Select unread</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Clear selection</a></li>
                                        </ul>
                                    </div>

                                    <div class="btn-group navbar-btn">
                                        <button type="button" class="btn btn-default"><i class="icon-pencil7"></i> <span
                                                    class="hidden-xs position-right">Composer</span></button>
                                        <button type="button" class="btn btn-default"><i class="icon-bin"></i> <span
                                                    class="hidden-xs position-right">Supprimer</span></button>
                                        <button type="button" class="btn btn-default"><i class="icon-spam"></i> <span
                                                    class="hidden-xs position-right">Spam</span></button>
                                    </div>

                                    <div class="navbar-right">
                                        <p class="navbar-text"><span class="text-semibold">1-50</span> of <span
                                                    class="text-semibold">528</span></p>

                                        <div class="btn-group navbar-left navbar-btn">
                                            <button type="button" class="btn btn-default btn-icon disabled"><i
                                                        class="icon-arrow-left12"></i></button>
                                            <button type="button" class="btn btn-default btn-icon"><i
                                                        class="icon-arrow-right13"></i></button>
                                        </div>

                                        <div class="btn-group navbar-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="icon-cog3"></i>
                                                <span class="caret"></span>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>
                                                <li><a href="#">One more line</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-inbox">
                                <tbody data-link="row" class="rowlink">
                                @if($paginator->count() > 0)
                                    @foreach($paginator as $oMessage)
                                        <tr class="unread">
                                            <td class="table-inbox-checkbox rowlink-skip">
                                                <input type="checkbox" class="styled" id="{{$oMessage->getUid()}}">
                                            </td>
                                            <td class="table-inbox-star rowlink-skip">
                                               <a href="{{url('/mails/'.$folder.'/'.$oMessage->getUid())}}">
                                                    <i class="icon-star-empty3 text-muted"></i>
                                                </a>
                                            </td>
                                            <td class="table-inbox-name">
                                               <a href="{{url('/mails/'.$folder.'/'.$oMessage->getUid())}}">
                                                    <div class="letter-icon-title text-default">
                                                        {{$oMessage->getSender()[0]->mail}}
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="table-inbox-message">
                                               <a href="{{url('/mails/'.$folder.'/'.$oMessage->getUid())}}">
                                                    <div class="table-inbox-subject">{{$oMessage->getSubject()}}</div>
                                                    <span class="table-inbox-preview"> ...</span>
                                                </a>
                                            </td>
                                            <td class="table-inbox-attachment">
                                               <a href="{{url('/mails/'.$folder.'/'.$oMessage->getUid())}}">
                                                    @if($oMessage->getAttachments()->count() > 0)
                                                        <i class="icon-attachment text-muted"></i>
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="table-inbox-time">
                                               <a href="{{url('/mails/'.$folder.'/'.$oMessage->getUid())}}">
                                                    {{$oMessage->getDate()}}
                                                </a>
                                            </td>
                                        </tr>

                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Pas de messages</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @php
                        $paginator->withPath($folder)
                    @endphp
                    {{$paginator->links()}}
                    <br><br>
                    <!-- /multiple lines -->

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

        });
    </script>
@endsection

