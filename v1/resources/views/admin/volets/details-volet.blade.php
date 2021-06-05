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
                    <div class="page-header-content hidden">
                        <div class="page-title">
                            <h4>
                                <i class="icon-files-empty position-left"></i>
                                <span class="text-semibold">Details Volet</span>
                            </h4>
                        </div>
                        @include('includes.utilisateur-page-header')
                    </div>

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{url('/fiches/etat/1')}}"><i class="icon-home2 position-left"></i> Accueil
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/volets')}}">volets
                                </a>
                            </li>
                            <li class="active">
                                <a href="{{url('/volet/'.$volet->id)}}">
                                    {{$volet->valeur}}
                                </a>
                            </li>
                        </ul>
                        <ul class="breadcrumb-elements hidden">
                            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-gear position-left"></i>
                                    Settings
                                    <span class="caret"></span>
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
                <div class="content p0">
                    <div class="col-md-12">
                        @if(Session::has('message'))
                            <div class="rounded0 alert {{Session::get('alert-class') }}">
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>×</span>
                                    <span class="sr-only">Close</span>
                                </button> {{ Session::get('message') }}
                            </div>
                        @endif
                        <form action="{{url('/volet/'.$volet->id)}}"
                              method="post">
                            <input type="hidden" name="id" value="{{$volet->id}}">
                            @csrf
                            <div class="panel registration-form">
                                <div class="panel-body">
                                    <div class="text-center">
                                        <div class="icon-object border-success text-success"><i
                                                    class="icon-drawer"></i>
                                        </div>
                                        <h5 class="content-group-lg">Régime informations
                                            <small class="display-block hidden">All fields are required</small>
                                        </h5>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="valeur"
                                                       placeholder="Valeur"
                                                       value="{{$volet->valeur}}">
                                                <div class="form-control-feedback">
                                                    <i class="icon-user-check text-muted"></i>
                                                </div>
                                                @if ($errors->has('valeur'))
                                                    <span class="text-danger error-msg" role="alert">
                                                        <strong class="text-danger">{{ $errors->first('valeur') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-feedback">
                                                <textarea type="text" class="form-control" name="description" rows="5"
                                                          placeholder="Description">{{$volet->description}}</textarea>
                                                @if ($errors->has('description'))
                                                    <span class="text-danger error-msg">
                                                         <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-file-text3 text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right mt-20">
                                        <button type="submit"
                                                class="rounded0 btn bg-teal-400 btn-labeled btn-labeled-right ml-10">
                                            <b>
                                                <i class="icon-plus3"></i>
                                            </b>
                                            Enregistrer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="panel panel-flat rounded0">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    Liste des sous-volets
                                    <button onclick="window.location.href='{{url('/volet/'.$volet->id.'/nouveau-sous-volet')}}'"
                                            class="ml-20 rounded0 text-white btn btn-success btn-xs-custom"><i
                                                class="icon-plus-circle2"></i> Ajouter un sous-volet
                                    </button>
                                </h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                    </ul>
                                </div>
                            </div>


                            <table class="table basic-datatable table-striped">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th class="hidden"></th>
                                    <th class="hidden"></th>
                                    <th>Gamme</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($volet->sousVolets as $sousVolet)
                                    <tr>
                                        <td>{{$sousVolet->valeur}}</td>
                                        <td>{{$sousVolet->description}}</td>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        <td>
                                            @if(!empty($sousVolet->gamme))
                                                {{ucfirst($sousVolet->gamme->nom)}}
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-menu9"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li>
                                                            <a class="confirm-delete" data-href="{{url('/volet/'.$volet->id.'/sous-volet/'.$sousVolet->id.'/suppression')}}">
                                                                <i class="icon-trash">
                                                                </i> Supprimer
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{url('/volet/'.$volet->id.'/sous-volet/'.$sousVolet->id)}}">
                                                                <i class="icon-eye2"></i> Voir les details</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="4">
                                            <h6>aucun sous-volet</h6>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.basic-datatable').DataTable({
                                "pageLength": 10,
                                //stateSave: true
                            });
                        });
                    </script>
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



