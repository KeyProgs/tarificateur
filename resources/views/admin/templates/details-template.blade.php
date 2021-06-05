@extends('layouts.utilisateur')

@section('content')
    <script src="{{asset('js/templates/template.js')}}"></script>
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
                                <span class="text-semibold">Nouvelle Compagnie</span>
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
                                <a href="{{url('/templates')}}">Templates
                                </a>
                            </li>
                            <li class="active">Nouvelle Template</li>
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
                        <form action="{{url('/templates/'.$template->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$template->id}}">
                            <div class="panel registration-form">
                                <div class="panel-body">
                                    <div class="text-center">
                                        <div class="icon-object border-success text-success"><i
                                                    class="icon-pen2"></i>
                                        </div>
                                        <h5 class="content-group-lg">Template Modification
                                            <small class="display-block hidden">All fields are required</small>
                                        </h5>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="nom" placeholder="Nom"
                                                       value="{{$template->nom}}">
                                                <div class="form-control-feedback">
                                                    <i class="icon-file-text text-muted"></i>
                                                </div>
                                                @if ($errors->has('nom'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('nom') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">


                                                <select name="type_id" id="type_id"
                                                        class="bootstrap-select form-control">
                                                    <option value="" disabled>Choisir le type</option>
                                                    @foreach($template_types as $type)
                                                        <option @if($template->type_id==$type->id) selected
                                                                @endif value="{{$type->id}}"> {{$type->type}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="form-control-feedback">
                                                    <i class="icon-file-text text-muted"></i>
                                                </div>
                                                @if($errors->has('type_id'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('type_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                    @php
                                        $tmplt = new \App\Template();
                                        $vars = $tmplt->Vars;
                                    @endphp
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-9">
                                                <div class="form-group has-feedback">
                                                <textarea type="text" cols="18" rows="10"
                                                          class="wysihtml5 wysihtml5-default form-control" id="template"
                                                          name="template" rows="5"
                                                          placeholder="Template">{{$template->template}}</textarea>
                                                    @if ($errors->has('template'))
                                                        <span class="text-danger error-msg">
                                                         <strong class="text-danger">{{ $errors->first('template') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="col-md-12">
                                                    <div class="content-group">

                                                        <ul class="list-group">
                                                            <li class="list-group-header text-center">Insertion des
                                                                variables
                                                            </li>
                                                            @foreach($vars as $i=>$v)
                                                                @if(@sizeof($v)>0)
                                                                    @foreach($v as $key => $value)
                                                                        <li data-variable="{{$key}}"
                                                                            class="template-variable cursor-pointer list-group-item">
                                                                            {{$key}}
                                                                        </li>
                                                                    @endforeach
                                                                @else
                                                                    <li data-variable="{{$i}}"
                                                                        class="template-variable cursor-pointer list-group-item">
                                                                        {{$i}}
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
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






