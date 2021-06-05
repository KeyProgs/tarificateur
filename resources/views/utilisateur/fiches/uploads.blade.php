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
                            <li class="active">{{$fiche->nom}}</li>
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
                        <form action="{{url('/fiche-details/'.$fiche->id.'/uploads')}}"
                              method="post" enctype="multipart/form-data">
                            <input type="hidden" name="fiche_id" value="{{$fiche->id}}">
                            @csrf
                            <div class="panel registration-form">
                                <div class="panel-body">
                                    <div class="text-center">
                                        <h5 class="content-group-lg">Fiche Piece Jointes
                                            <small class="display-block hidden">All fields are required</small>
                                        </h5>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <select name="type_id" id="type_id"
                                                        class="bootstrap-select form-control">
                                                    @foreach($types_pieces_jointe as $type)
                                                        <option value="{{$type->id}}">{{$type->type}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="form-control-feedback">
                                                    <i class="icon-user-check text-muted"></i>
                                                </div>
                                                @if ($errors->has('type_id'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('type_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <textarea rows="6" class="form-control" name="description"
                                                          placeholder="Description"></textarea>
                                                <div class="form-control-feedback">
                                                    <i class="icon-home2 text-muted"></i>
                                                </div>
                                                @if ($errors->has('description'))
                                                    <span class="text-danger error-msg" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="file" name="pieces_jointes[]" class="file-input"
                                                   multiple="multiple">

                                            @if ($errors->has('pieces_jointes.*'))
                                                <span class="text-danger error-msg">
                                                <strong class="text-danger"> - {{ $errors->first('pieces_jointes.*') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit"
                                                    class="rounded0 btn bg-teal-400 btn-labeled btn-labeled-right ml-10">
                                                <b><i class="icon-plus3"></i></b>
                                                Enregistrer
                                            </button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </form>

                        <div class="col-md-7 panel panel-flat rounded0">
                            <div class="panel-heading">
                                Enregistrements
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse">  </a></li>
                                    </ul>
                                </div>
                            </div>


                            <table class="table basic-datatable table-striped">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($fiche->piece_jointes as $piece)
                                    @if(strpos($piece->url,".mp3") == true|| strpos($piece->url,".wav") == true)
                                        <tr>
                                            <td>{{$piece->url}}</td>
                                            <td>{{$piece->description}}</td>


                                            <td class="text-center">
                                                <a href="{{url('/uploads/pieces-jointes/fiches/'.$fiche->id.'/'.$piece->url)}}"
                                                   title="Telecharger">
                                                    <i class="icon-eye2"></i>
                                                </a>
                                                &nbsp;&nbsp;
                                                <a class="confirm-delete"
                                                   data-href="{{url('/fiche-details/'.$fiche->id.'/uploads/'.$piece->id.'/suppression')}}"
                                                   title="Supprimer"><i class="icon-trash"></i>
                                                </a>

                                                @if(strpos($piece->url,".mp3") == true|| strpos($piece->url,".wav"))
                                                    <audio controls>
                                                        <source src="{{url('/uploads/pieces-jointes/fiches/'.$fiche->id.'/'.$piece->url)}}" type="audio/mp3">
                                                        <source src="{{url('/uploads/pieces-jointes/fiches/'.$fiche->id.'/'.$piece->url)}}" type="audio/ogg">
                                                        <p>Votre navigateur ne prend pas en charge l'audio HTML. Voici un
                                                            un <a href="{{url('/uploads/pieces-jointes/fiches/'.$fiche->id.'/'.$piece->url)}}">lien vers le fichier audio</a> pour le
                                                            télécharger.</p>
                                                    </audio>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif

                                @empty
                                    <tr>
                                        <td class="text-center" colspan="4">
                                            <h6>Aucune Piece Jointe</h6>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                            <div class="col-md-1"></div>

                        <div class="col-md-4 panel panel-flat rounded0 ">
                            <div class="panel-heading">
                                Documents
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
                                    <th>Type</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($fiche->piece_jointes as $piece)
                                    @if(strpos($piece->url,".mp3") == false && strpos($piece->url,".wav")== false)
                                     <tr>
                                        <td>{{$piece->url}}</td>
                                        <td>{{$piece->description}}</td>
                                        <td>{{$piece->type->type}}</td>
                                        <td class="text-center">
                                            <a href="{{url('/uploads/pieces-jointes/fiches/'.$fiche->id.'/'.$piece->url)}}"
                                               title="Telecharger">
                                                <i class="icon-eye2"></i>
                                            </a>
                                            &nbsp;&nbsp;
                                            <a class="confirm-delete"
                                               data-href="{{url('/fiche-details/'.$fiche->id.'/uploads/'.$piece->id.'/suppression')}}"
                                               title="Supprimer"><i class="icon-trash"></i>
                                            </a>

                                            @if(strpos($piece->url,".mp3") == true|| strpos($piece->url,".wav"))
                                                <audio controls>
                                                    <source src="{{url('/uploads/pieces-jointes/fiches/'.$fiche->id.'/'.$piece->url)}}" type="audio/mp3">
                                                    <source src="{{url('/uploads/pieces-jointes/fiches/'.$fiche->id.'/'.$piece->url)}}" type="audio/ogg">
                                                    <p>Votre navigateur ne prend pas en charge l'audio HTML. Voici un
                                                        un <a href="{{url('/uploads/pieces-jointes/fiches/'.$fiche->id.'/'.$piece->url)}}">lien vers le fichier audio</a> pour le
                                                        télécharger.</p>
                                                </audio>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="4">
                                            <h6>Aucune Piece Jointe</h6>
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



