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
                                <span class="text-semibold">Details Compagnie</span>
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
                                <a href="{{url('/compagnies')}}">Compagnies
                                </a>
                            </li>
                            <li class="active">{{$compagnie->nom}}</li>
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
                        <form action="{{url('/compagnie/'.$compagnie->id)}}"
                              method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$compagnie->id}}">
                            @csrf
                            <div class="panel registration-form">
                                <div class="panel-body">
                                    <div class="text-center">

                                            @if(!empty($compagnie->logo))
                                                <img class=""
                                                     style="width: 60px !important;height: 60px !important;border: 1px solid grey;"
                                                     src="{{asset('/uploads/img/compagnies/'.$compagnie->logo)}}">
                                            @endif

                                        <h5 class="content-group-lg">{{$compagnie->nom}}
                                            <small class="display-block hidden">All fields are required</small>
                                        </h5>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="nom" placeholder="Nom"
                                                       value="{{$compagnie->nom}}">
                                                <div class="form-control-feedback">
                                                    <i class="icon-user-check text-muted"></i>
                                                </div>
                                                @if ($errors->has('nom'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('nom') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="adresse1"
                                                       placeholder="Adresse 1" value="{{$compagnie->adresse1}}">
                                                <div class="form-control-feedback">
                                                    <i class="icon-home2 text-muted"></i>
                                                </div>
                                                @if ($errors->has('adresse1'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('adresse1') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="adresse2"
                                                       placeholder="Adresse 2" value="{{$compagnie->adresse2}}">
                                                @if ($errors->has('adresse2'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('adresse2') }}</strong>
                                                </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-home2 text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="telephone1"
                                                       placeholder="Téléphone" value="{{$compagnie->telephone1}}">
                                                @if ($errors->has('telephone1'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('telephone1') }}</strong>
                                                </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-phone2 text-muted"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="telephone2"
                                                       placeholder="Téléphone 2" value="{{$compagnie->telephone2}}">
                                                @if ($errors->has('telephone2'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('telephone2') }}</strong>
                                                </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-phone2 text-muted"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group has-feedback"> Logo
                                                <input type="file" name="logo" class="file-styled">
                                                @if ($errors->has('logo'))
                                                    <span class="text-danger error-msg">
                                                         <strong class="text-danger">{{ $errors->first('logo') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-feedback">
                                            <textarea type="text" class="form-control" name="description" rows="5"
                                                      placeholder="Description">{{$compagnie->description}}</textarea>
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
                                            <b><i class="icon-plus3"></i></b> Enregistrer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="panel panel-flat rounded0">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    Liste des gammes
                                    <button onclick="window.location.href='{{url('/compagnie/'.$compagnie->id.'/nouvelle-gamme')}}'"
                                            class="ml-20 rounded0 text-white btn btn-success btn-xs-custom"><i
                                                class="icon-plus-circle2"></i> Ajouter une gamme
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
                                    <th>Type Assurance</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($compagnie->gammes as $gamme)
                                    <tr>
                                        <td>{{$gamme->nom}}</td>
                                        <td>{{$gamme->description}}</td>
                                        <td>{{ucfirst($gamme->type_assurance->nom)}}</td>

                                        <td>
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-menu9"></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-trash"></i> Supprimer</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{url('/compagnie/'.$compagnie->id.'/gamme/'.$gamme->id)}}"><i
                                                                        class="icon-eye2"></i> Voir les details</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="4">
                                            <h6>Aucune Gamme</h6>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
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



