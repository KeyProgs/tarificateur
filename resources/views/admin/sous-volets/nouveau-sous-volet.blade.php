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
                <div class="page-header page-header-default ">
                    <div class="page-header-content hidden">
                        <div class="page-title">
                            <h4>
                                <i class="icon-files-empty position-left"></i>
                                <span class="text-semibold">Nouveau Régime</span>
                            </h4>
                        </div>
                        @include('includes.utilisateur-page-header')
                    </div>

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{url('/fiches/etat/1')}}"><i class="icon-home2 position-left"></i>
                                    Accueil
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/volets')}}">volets
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/volet/'.$volet->id)}}">
                                    {{$volet->valeur}}
                                </a>
                            </li>
                            <li class="active">nouveau volet</li>
                        </ul>
                        <ul class="breadcrumb-elements hidden">
                            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support </a></li>
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
                        <form action="{{url('/volet/'.$volet->id.'/nouveau-sous-volet')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="">
                            <div class="panel registration-form">
                                <div class="panel-body">
                                    <div class="text-center">
                                        <div class="icon-object border-success text-success"><i
                                                    class="icon-stairs"></i>
                                        </div>
                                        <h5 class="content-group-lg">Sous-volet informations
                                            <small class="display-block hidden">All fields are required</small>
                                        </h5>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="valeur" placeholder="Valeur"
                                                       value="{{old('valeur')}}">
                                                    <div class="form-control-feedback">
                                                        <i class="icon-font-size2 text-muted"></i>
                                                    </div>
                                                @if ($errors->has('valeur'))
                                                    <span class="text-danger error-msg" role="alert">
                                                        <strong class="text-danger">{{ $errors->first('valeur') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <select name="gamme_id" id="gamme_id"
                                                        class="bootstrap-select form-control">
                                                    <option value="" selected disabled>Choisir la gamme
                                                    </option>
                                                    @foreach($gammes as $gamme)
                                                        <option value="{{$gamme->id}}">
                                                            {{$gamme->nom}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="form-control-feedback">
                                                    <i class="icon-menu2 text-muted"></i>
                                                </div>
                                                @if ($errors->has('gamme_id'))
                                                    <span class="text-danger error-msg" role="alert">
                                                        <strong class="text-danger">{{ $errors->first('gamme_id') }}</strong>
                                                     </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="text" disabled readonly class="form-control" placeholder="Valeur"
                                                       value="Volet : {{$volet->valeur}}">
                                                <input type="hidden" name="volet_id" value="{{$volet->id}}">
                                                <div class="form-control-feedback">
                                                    <i class="icon-tree5 text-muted"></i>
                                                </div>
                                                @if ($errors->has('volet_id'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('volet_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
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
                                    </div>

                                    <div class="text-right mt-20">
                                        <button type="submit"
                                                class="rounded0 btn bg-teal-400 btn-labeled btn-labeled-right ml-10">
                                            <b><i class="icon-plus3"></i></b>
                                            Enregistrer
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



