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
                                <span class="text-semibold">Gestion des équipes </span>
                            </h4>
                        </div>
                        @include('includes.utilisateur-page-header')
                    </div>

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="{{url('/admin/fiches')}}"><i class="icon-home2 position-left"></i> Accueil
                                </a></li>
                            <li class="active">Nouvelle équipe</li>
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
                    <form id="equipe_forme" method="post" action="{{url('/equipe/'.$equipe->id)}}">
                        <input type="hidden" name="id" value="{{$equipe->id}}">
                    @csrf
                    <!-- equipe Section-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content-group border-top-lg border-top-primary">
                                    <div class="page-header page-header-default">
                                        <div class="breadcrumb-line">
                                            <a class="breadcrumb-elements-toggle">
                                                <i class="icon-menu-open"></i>
                                            </a>
                                            <ul class="breadcrumb">
                                                <li class="text-bold">
                                                    <i class="icon-file-empty2 position-left"></i>
                                                    Informations
                                                </li>
                                            </ul>

                                            <ul class="breadcrumb-elements hidden">
                                                <li>
                                                    <a href="#" class="legitRipple">
                                                        <i class="icon-comment-discussion position-left"></i>
                                                        Support
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="legitRipple"><i
                                                                class="icon-comment-discussion position-left"></i>
                                                        Support
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="page-header-content">
                                            <div class="row pt-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">Nom </label>
                                                        <input type="text" name="nom" id="nom"
                                                               class="mt-m15 form-control" value="{{$equipe->valeur}}">
                                                        @if ($errors->has('nom'))
                                                            <span class="text-danger error-msg">
                                                             <strong class="text-danger">{{ $errors->first('nom') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">Adresse 1 </label>
                                                        <input type="text" name="adresse1" id="adresse1"
                                                               class="mt-m15 form-control" value="{{$equipe->adresse1}}">
                                                        @if ($errors->has('adresse1'))
                                                        <span class="text-danger error-msg">
                                                             <strong class="text-danger">{{ $errors->first('adresse1') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">Adresse 2 </label>
                                                        <input type="text" name="adresse2" id="adresse2"
                                                               class="mt-m15 form-control" value="{{$equipe->adresse2}}">
                                                        @if ($errors->has('adresse2'))
                                                            <span class="text-danger error-msg">
                                                             <strong class="text-danger">{{ $errors->first('adresse2') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">Est une agence ? </label>

                                                        <select class="mt-m15 form-control"  name="agence" id="agence">
                                                            <option @if($equipe->agence=="0") selected @endif value="0">Non</option>
                                                            <option @if($equipe->agence=="1") selected @endif value="1">Oui</option>
                                                        </select>
                                                        @if ($errors->has('agence'))
                                                            <span class="text-danger error-msg">
                                                             <strong class="text-danger">{{ $errors->first('agence') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">Téléphone 1 </label>
                                                        <input type="text" name="tel1" id="tel1"
                                                               class="mt-m15 form-control" value="{{$equipe->tel1}}">
                                                        @if ($errors->has('tel1'))
                                                            <span class="text-danger error-msg">
                                                             <strong class="text-danger">{{ $errors->first('tel1') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">Téléphone 2 </label>
                                                        <input type="text" name="tel2" id="tel2"
                                                               class="mt-m15 form-control" value="{{$equipe->tel2}}">
                                                        @if ($errors->has('tel2'))
                                                            <span class="text-danger error-msg">
                                                             <strong class="text-danger">{{ $errors->first('tel2') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">Téléphone 3 </label>
                                                        <input type="text" name="tel3" id="tel3"
                                                               class="mt-m15 form-control" value="{{$equipe->tel3}}">
                                                        @if ($errors->has('tel3'))
                                                            <span class="text-danger error-msg">
                                                             <strong class="text-danger">{{ $errors->first('tel3') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">Email</label>
                                                        <input type="text" name="email" id="email"
                                                               class="mt-m15 form-control" value="{{$equipe->email}}">
                                                        @if($errors->has('email'))
                                                        <span class="text-danger error-msg">
                                                             <strong class="text-danger">{{$errors->first('email') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">Code postale </label>
                                                        <input type="text" name="code_postal" id="code_postal"
                                                               class="mt-m15 form-control" value="{{$equipe->code_postal}}">
                                                        @if ($errors->has('code_postal'))
                                                            <span class="text-danger error-msg">
                                                             <strong class="text-danger">{{ $errors->first('code_postal') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">Ville </label>
                                                        <select name="ville_id" id="ville_id"
                                                                class="mt-m15 bootstrap-select form-control form-control-sm"
                                                                style="padding: 8px;">
                                                            @if($equipe->ville_id != null)
                                                             <option value="{{$equipe->ville->id}}">{{$equipe->ville->name}}</option>
                                                            @endif
                                                        </select>

                                                        @if ($errors->has('ville_id'))
                                                            <span class="text-danger error-msg">
                                                             <strong class="text-danger">{{ $errors->first('ville_id') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">
                                                            Description :
                                                        </label>
                                                        <textarea rows="5" name="description" id="description"
                                                                  class="mt-m15 form-control">{{$equipe->description}}</textarea>
                                                        @if ($errors->has('description'))
                                                            <span class="text-danger error-msg">
                                                             <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="text-right pb-20">
                                                        <button type="submit"
                                                                class="rounded0 btn btn-primary legitRipple">
                                                            Enregistrer
                                                            <i class="icon-arrow-right14 position-right"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /equipe Section-->
                    </form>
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
            /*$('.basic-datatable').DataTable({
                "pageLength": 10,
                //stateSave: true
            });*/
        });
    </script>
@endsection



