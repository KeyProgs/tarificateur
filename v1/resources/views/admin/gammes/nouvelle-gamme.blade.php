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
                                <span class="text-semibold">Nouvelle Gamme</span>
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
                                <a href="{{url('/compagnie/'.$compagnie->id)}}">
                                    {{ucfirst($compagnie->nom)}}
                                </a>
                            </li>
                            <li class="active">Nouvelle Gamme</li>
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
                        <form action="{{url('/compagnie/'.$compagnie->id.'/nouvelle-gamme')}}" method="post">
                            @csrf
                            <input type="hidden" name="compagnie_id" value="{{$compagnie->id}}">
                            <div class="panel registration-form">
                                <div class="panel-body">
                                    <div class="text-center">
                                        <div class="icon-object border-success text-success">
                                            <i class="icon-cabinet"></i>
                                        </div>
                                        <h5 class="content-group-lg">Gamme informations
                                            <small class="display-block hidden">All fields are required</small>
                                        </h5>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="nom" placeholder="Nom"
                                                       value="{{old('nom')}}">
                                                <div class="form-control-feedback">
                                                    <i class="icon-cabinet text-muted"></i>
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
                                                <select name="type_assurance_id" id="type_assurance_id"
                                                        class="bootstrap-select form-control">
                                                    <option value="" selected disabled>Choisir le type assurance
                                                    </option>
                                                    @foreach($type_assurances as $type_assurance)
                                                        <option value="{{$type_assurance->id}}">
                                                            {{$type_assurance->nom}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="form-control-feedback">
                                                    <i class="icon-menu2 text-muted"></i>
                                                </div>
                                                @if ($errors->has('type_assurance_id'))
                                                    <span class="text-danger error-msg" role="alert">
                                                        <strong class="text-danger">{{ $errors->first('type_assurance_id') }}</strong>
                                                     </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="annee" placeholder="Annee"
                                                       value="{{old('annee')}}">
                                                @if ($errors->has('annee'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('annee') }}</strong>
                                                </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-calendar text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="e_age"
                                                       placeholder="Enfant Age 1" value="{{old('e_age')}}">
                                                @if ($errors->has('e_age'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('e_age') }}</strong>
                                                </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-users2 text-muted"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="e_age2"
                                                       placeholder="Enfant Age 2" value="{{old('e_age2')}}">
                                                @if ($errors->has('e_age2'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('e_age2') }}</strong>
                                                </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-users2 text-muted"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="min_age"
                                                       placeholder="Min Age" value="{{old('min_age')}}">
                                                @if ($errors->has('min_age'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('min_age') }}</strong>
                                                </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-sort-numberic-desc text-muted"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="max_age"
                                                       placeholder="Max Age" value="{{old('max_age')}}">
                                                @if ($errors->has('max_age'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('max_age') }}</strong>
                                                </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-sort-numeric-asc text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group has-feedback">
                                            <textarea type="text" class="form-control" name="description" rows="5"
                                                      placeholder="Description">{{old('description')}}</textarea>
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

                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" readonly=""
                                                       value="Gamme : {{ucfirst($compagnie->nom)}}">
                                                <div class="form-control-feedback">
                                                    <i class="icon-city text-muted"></i>
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



