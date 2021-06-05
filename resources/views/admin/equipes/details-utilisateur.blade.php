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
                                <span class="text-semibold">Nouveau Utilisateur</span>
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
                            <li class="active">Utilisateur Modification</li>
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
                        <form action="{{url('/equipe/'.$user_equipe->equipe_id.'/users/'.$user_equipe->user_id)}}"
                              method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <input type="hidden" name="old_equipe_id" value="{{$user_equipe->equipe_id}}">
                            <div class="panel registration-form">
                                <div class="panel-body">
                                    <div class="text-center">
                                        <div class="icon-object border-success text-success"><i
                                                    class="icon-user-check"></i>
                                        </div>
                                        <h5 class="content-group-lg">Utilisateur Modification
                                            <small class="display-block hidden">All fields are required</small>
                                        </h5>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="nom" placeholder="Nom"
                                                       value="{{$user->nom}}">
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
                                                <input type="text" class="form-control" name="prenom"
                                                       placeholder="Prenom"
                                                       value="{{$user->prenom}}">
                                                <div class="form-control-feedback">
                                                    <i class="icon-user-check text-muted"></i>
                                                </div>
                                                @if ($errors->has('prenom'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('prenom') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="titre"
                                                       placeholder="Titre" value="{{$user->titre}}">
                                                @if ($errors->has('titre'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('titre') }}</strong>
                                                </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-user text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <input type="date" class="form-control" name="date_naissance"
                                                       placeholder="Date Naissance" value="{{$user->date_naissance}}">
                                                @if ($errors->has('date_naissance'))
                                                    <span class="text-danger error-msg">
                                                 <strong class="text-danger">{{ $errors->first('date_naissance') }}</strong>
                                            </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-calendar text-muted"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="telephone"
                                                       placeholder="Téléphone" value="{{$user->telephone}}">
                                                @if ($errors->has('telephone'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('telephone') }}</strong>
                                                </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-phone2 text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-feedback">
                                            <textarea type="text" class="form-control" name="adresse" rows="5"
                                                      placeholder="Adresse">{{$user->adresse}}</textarea>
                                                @if ($errors->has('adresse'))
                                                    <span class="text-danger error-msg">
                                                 <strong class="text-danger">{{ $errors->first('adresse') }}</strong>
                                            </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-city text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <!--<input type="text" class="form-control" name="email"
                                                       placeholder="Adresse e-mail" value="">-->
                                                <select class="bootstrap-select form-control form-control-sm"
                                                        name="role_id" id="role_id">
                                                    <option value="" disabled>Choisir le role</option>
                                                    @foreach($roles as $role)
                                                        <option @if($user->role_id==$role->id) selected
                                                                @endif value="{{$role->id}}">{{$role->libelle}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('role_id'))
                                                    <span class="text-danger error-msg">
                                                         <strong class="text-danger">{{ $errors->first('role_id') }}</strong>
                                                    </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-user-check text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <select class="form-control form-control-sm"
                                                         name="equipe_id[]" id="equipe_id" @if(!$user->isRole("agent")) multiple @endif>
                                                    <option value="" disabled>Choisir l'équipe</option>
                                                    @foreach($equipes as $equipe)
                                                        <option
                                                                @if(in_array($equipe->id,$user_equipes)) selected
                                                                @endif value="{{$equipe->id}}">{{$equipe->libelle}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('equipe_id'))
                                                    <span class="text-danger error-msg">
                                                 <strong class="text-danger">{{ $errors->first('equipe_id') }}</strong>
                                            </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-user-lock text-muted"></i>
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" name="email"
                                                       placeholder="Adresse e-mail" value="{{$user->email}}">
                                                @if ($errors->has('email'))
                                                    <span class="text-danger error-msg">
                                                 <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                            </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-mention text-muted"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="password" class="form-control" name="password"
                                                       placeholder="Mot de passe">
                                                @if ($errors->has('password'))
                                                    <span class="text-danger error-msg">
                                                 <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                            </span>
                                                @endif
                                                <div class="form-control-feedback">
                                                    <i class="icon-user-lock text-muted"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <input type="password" class="form-control" name="password_confirmation"
                                                       placeholder="Mot de passe confirmation">
                                                <div class="form-control-feedback">
                                                    <i class="icon-user-lock text-muted"></i>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="display-block text-bold">Affectation des types
                                                        d'assurances
                                                    </label>

                                                    @foreach($types_assurances as $type_assurance)
                                                        <label class="checkbox-inline">
                                                            <input name="types_assurance[]" type="checkbox"
                                                                   value="{{$type_assurance->id}}"
                                                                   @if(in_array($type_assurance->id,$user_type_assurances_array))
                                                                     checked="checked"
                                                                   @endif>
                                                            {{$type_assurance->nom}}
                                                        </label>
                                                    @endforeach
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
    <script type="text/javascript">
        $(document).ready(function () {
            var equipe_id = $("#equipe_id");
            $('#role_id').on('change', function () {
                if (this.value == "1") {
                    equipe_id.removeAttr('multiple');
                    //$("#equipe_id").selectpicker('refresh');
                } else {
                    equipe_id.attr('multiple','multiple');
                    //$("#equipe_id").selectpicker('refresh');
                }
            });
        });

    </script>
@endsection



