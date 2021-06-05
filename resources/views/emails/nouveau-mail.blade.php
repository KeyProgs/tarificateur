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
                <div class="page-header page-header-default">

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{url('/fiches/etat/1')}}"><i class="icon-home2 position-left"
                                                                       style="font-size: 15px;"></i> Accueil
                                </a>
                            </li>
                            <li class="active">Nouveau Email</li>
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
                <div class="content">

                    <!-- Detached content -->
                    <div class="container-detached">
                        <div class="content-detached">
                            @if(Session::has('message'))
                                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-styled-left alert-arrow-left alert-bordered">
                                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                                class="sr-only">Close</span></button>
                                    <span class="text-semibold"> {{ Session::get('message') }} .</span>
                                </div>
                            @endif
                            <!-- Single mail -->
                                <div class="col-md-12 pl0 pr0">
                                    <div class="row">
                                        @include('emails.include-mail')
                                    </div>
                                </div>
                            <!--<form enctype="multipart/form-data" id="mailForm" class="form-horizontal" method="post">
                                @csrf
                                <div class="panel panel-white">


                                    <div class="panel-toolbar panel-toolbar-inbox">
                                        <div class="navbar navbar-default">
                                            <ul class="nav navbar-nav visible-xs-block no-border">
                                                <li>
                                                    <a class="text-center collapsed" data-toggle="collapse"
                                                       data-target="#inbox-toolbar-toggle-single">
                                                        <i class="icon-circle-down2"></i>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="navbar-collapse collapse" id="inbox-toolbar-toggle-single">
                                                <div class="btn-group navbar-btn">
                                                    <button type="button" class="btn-send-mail btn bg-blue"><i
                                                                class="icon-checkmark3 position-left"></i> Envoyer
                                                    </button>
                                                </div>

                                                <div class="btn-group navbar-btn">
                                                    <button type="button" class="btn-save-mail btn btn-default"><i
                                                                class="icon-plus2"></i>
                                                        <span class="hidden-xs position-right">Enregistrer</span>
                                                    </button>
                                                    <button type="button" class="btn btn-default"><i
                                                                class="icon-cross2"></i> <span
                                                                class="hidden-xs position-right">Annuler</span></button>

                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                                data-toggle="dropdown">
                                                            <i class="icon-menu7"></i>
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




                                    <div class="table-responsive mail-details-write">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td style="width: 150px"> À :</td>
                                                <td class="no-padding"><input name="recepteur" type="text"
                                                                              class="form-control"
                                                                              placeholder="Récepteur"
                                                                              value="{{old('recepteur')}}">

                                                    @if ($errors->has('recepteur'))
                                                        <span class="text-danger error-msg">
                                                            <strong class="text-danger"> - {{ $errors->first('recepteur') }}</strong>
                                                        </span>
                                                    @endif
                                                </td>
                                                <td style="width: 250px" class="text-right">
                                                    <ul class="list-inline list-inline-separate no-margin">
                                                        <li><a href="#">Copier</a></li>

                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Object :</td>
                                                <td class="no-padding">
                                                    <input name="objet" type="text" class="form-control"
                                                           placeholder="Ajouter l'objet" value="{{old('objet')}}">
                                                    @if ($errors->has('objet'))
                                                        <span class="text-danger error-msg">
                                                            <strong class="text-danger"> - {{ $errors->first('objet') }}</strong>
                                                        </span>
                                                    @endif
                                                </td>
                                                <td> &nbsp;</td>
                                            </tr>
                                            <tr style="display: none;">
                                                <td colspan="2">
                                                    <ul class="list-inline no-margin">
                                                        <li><a href="#"><i class="icon-attachment position-left"></i>
                                                                Joindre des fichiers </a></li>
                                                     </ul>
                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>




                                    <div class="mail-container-write">
                                    <textarea type="text" cols="18" rows="10"
                                              class="wysihtml5 wysihtml5-default form-control" id="message"
                                              name="message" rows="5"
                                              placeholder="Message">{{old('message')}}</textarea>
                                        @if ($errors->has('message'))
                                            <span class="text-danger error-msg">
                                            <strong class="text-danger"> - {{ $errors->first('message') }}</strong>
                                        </span>
                                        @endif
                                    </div>



                                </div>
                                <div class="panel panel-flat">

                                    <div class="panel-body">
                                        <b>
                                            <i class="icon-attachment position-left"></i>
                                            Joindre des fichiers
                                        </b>
                                        <br><br>
                                        <input type="file" name="pieces_jointes[]" class="file-input"
                                               multiple="multiple">

                                        @if ($errors->has('pieces_jointes.*'))

                                            <span class="text-danger error-msg">
                                                <strong class="text-danger"> - {{ $errors->first('pieces_jointes.*') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                </div>
                                 <div class="mail-attachments-container">
                                    <h6 class="mail-attachments-heading">2 Attachments</h6>

                                    <ul class="mail-attachments">
                                        <li>
                                            <span class="mail-attachments-preview">
                                                    <i class="icon-file-pdf icon-2x"></i>
                                            </span>

                                            <div class="mail-attachments-content">
                                                <span class="text-semibold">new_december_offers.pdf</span>

                                                <ul class="list-inline list-inline-condensed no-margin">
                                                    <li class="text-muted">174 KB</li>
                                                    <li><a href="#">View</a></li>
                                                    <li><a href="#">Remove</a></li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                                <span class="mail-attachments-preview">
                                                    <i class="icon-file-pdf icon-2x"></i>
                                                </span>

                                            <div class="mail-attachments-content">
                                                <span class="text-semibold">assignment_letter.pdf</span>

                                                <ul class="list-inline list-inline-condensed no-margin">
                                                    <li class="text-muted">736 KB</li>
                                                    <li><a href="#">View</a></li>
                                                    <li><a href="#">Remove</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </form>-->
                        </div>
                        <!-- /single mail -->
                    </div>
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

@endsection




