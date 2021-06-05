@extends('layouts.utilisateur')
@section('content')
    <script src="{{asset('js/fiches/fiche.js')}}"></script>
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
            <!--utilisateur-sidebar-->
            <form id="fiche_forme">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Page header -->
                    <div class="page-header page-header-default">
                        @include('includes.utilisateur-page-header')

                        <div class="breadcrumb-line">
                            <ul class="breadcrumb">
                                <li><a href="/fiches/etat/1"><i class="icon-home2 position-left"></i> Accueil </a></li>
                                <li class="active">Fiche Details</li>
                            </ul>


                            <div class="col-md-2">
                                <div class="">
                                    <label class="text-custom-grey text-bold">Provenance </label>
                                    <select name="provenance_id" id="provenance_id"
                                            class=" bootstrap-select  form-control form-control-sm"
                                            style="    padding: 8px;">
                                        <option value=""></option>
                                        @foreach($provenances as $provenance)
                                            <option @if($fiche->provenance->id == $provenance->id) selected
                                                    @endif value="{{$provenance->id}}"> {{$provenance->libelle}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-msg"
                                          id="error_provenance_id">
                                                     <strong class="text-danger"></strong>
                                    </span>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Date d'éffet </label>

                                    <input type="text" name="date_effet" id="date_effet"
                                           class="date-picker  form-control"
                                           style="font-size: 20px; font-weight: bold;"
                                           value="{{$fiche->date_effet != null ? Helper::getDateFormat($fiche->date_effet) : \Carbon\Carbon::now()->tomorrow()->format('d/m/Y') }}">

                                    <span class="text-danger error-msg"
                                          id="error_date_effet">
                                                     <strong class="text-danger"></strong>
                                    </span>
                                </div>
                            </div>


                            <ul class="breadcrumb-elements">
                                <li class="modal-sms-launch">
                                    <a href="#"><i class="icon-comment-discussion position-left"></i> Envoyer un SMS
                                    </a>
                                </li>
                                <li class="modal-mail-launch">
                                    <a href="#"><i class="icon-mail5 position-left"></i> Envoyer un Email </a>
                                </li>
                                <li class="modal-resiliation-launch"><a href="#"><i
                                                class="icon-office text-primary"></i> Résiliations</a></li>
                                <li class="modal-paiement-launch"><a href="#"><i
                                                class="icon-coin-euro text-primary"></i> COMPTE DE PAIMENT</a></li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-phone position-left"></i>
                                        Appel
                                        <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @php
                                            $equipe= Auth::user()->equipes[0];


                                            $local_server='@'.$equipe->local_server;
                                        @endphp
                                        <li>
                                            <a href="SIP:{{$fiche->personne->details->telephone_1}}{{$local_server}}"><i
                                                        class=" icon-phone-outgoing"></i> {{$fiche->personne->details->telephone_1}}
                                            </a></li>
                                        <li><a href="SIP:{{$fiche->personne->details->telephone_2}}{{$local_server}}"><i
                                                        class=" icon-phone-outgoing"></i> {{$fiche->personne->details->telephone_2}}
                                            </a></li>
                                        <li><a href="SIP:{{$fiche->personne->details->telephone_3}}{{$local_server}}"><i
                                                        class=" icon-phone-outgoing"></i> {{$fiche->personne->details->telephone_3}}
                                            </a></li>
                                        <li class="divider"></li>
                                        <li><a href="#"><i class="icon-gear"></i> Historique d'appel</a></li>
                                    </ul>
                                </li>
                                <li class="modal-password-launch">
                                    <a href="#"><i class="icon-lock"></i> Mot de pass</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /page header -->

                    <!-- Content area -->
                    <div class="content p0">

                        <div class="col-md-12">
                            @if(Session::has('message'))
                                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-styled-left alert-arrow-left alert-bordered">
                                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                                class="sr-only">Close</span></button>
                                    <span class="text-semibold"> {{ Session::get('message') }} .</span>
                                </div>
                        @endif

                        <!--Section fiche informations -->
                            <div class="col-lg-9" id="fiche-div">
                            @csrf
                            <!-- Fiche Section-->
                                <div class="row">
                                    <input type="hidden" id="fiche_id" value="{{$fiche->id}}" name="fiche_id">
                                    @if(!empty($fiche->simulation))
                                        <input type="hidden" id="simulation_id" value="{{$fiche->simulation->id}}"
                                               name="simulation_id">
                                    @endif
                                    <div class="col-md-12 hidden">
                                        <div class="content-group border-top-lg border-top-primary">
                                            <div class="page-header page-header-default">
                                                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i
                                                                class="icon-menu-open"></i></a>
                                                    <ul class="breadcrumb">
                                                        <li class="text-bold"><i
                                                                    class="icon-file-empty2 position-left"></i>
                                                            Informations de la fiche :
                                                            <br>

                                                        </li>
                                                    </ul>


                                                </div>

                                                <div class="page-header-content">
                                                    <div class="row pt-10 pb-20">


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /fiche Section-->

                                <!-- Prospect & Conjoint sections-->
                                <div class="row">
                                    @include('utilisateur.fiches.details-fiche-includes.prospect')

                                    @include('utilisateur.fiches.details-fiche-includes.conjoint')
                                </div>
                                <!--/Prospect & Conjoint sections-->

                            @include('utilisateur.fiches.details-fiche-includes.enfants')

                            @include('utilisateur.fiches.details-fiche-includes.details-prospect')
                            <!-- piece jointe section-->
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="panel panel-flat rounded0">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    Piéces jointes
                                                    <button type="button"
                                                            class="launch-modal-upload ml-20 rounded0 text-white btn btn-success btn-xs-custom">
                                                        <i class="icon-plus-circle2"></i> Ajouter une pièce jointe
                                                    </button>
                                                </h5>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li><a data-action="collapse"></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <ul class="mail-attachments p-20">
                                                @foreach($fiche->piece_jointes as $piece)
                                                    <li>
                            <span class="mail-attachments-preview">
                                <i class="icon-file-upload icon-2x"></i>
                            </span>
                                                        <div class="mail-attachments-content">
                                                            <span class="text-semibold">@if($piece->description != null) {{$piece->description}} @else {{$piece->url}} @endif</span>
                                                            <ul class="list-inline list-inline-condensed no-margin">
                                                                <!--<li class="text-muted">174 KB</li>-->
                                                                <li>
                                                                    <a data-type="fiche" data-type-id="{{$fiche->id}}"
                                                                       data-id="{{$piece->id}}"
                                                                       data-href="{{url('/fiche/'.$fiche->id.'/piece-jointe/'.$piece->id)}}"
                                                                       class="get-file-infos">Voir
                                                                        les details</a></li>
                                                                <li><a target="_blank"
                                                                       href="{{asset('uploads/pieces-jointes/fiches/'.$piece->url)}}">Telecharger</a>
                                                                </li>
                                                                <li><a target="" class="confirm-delete"
                                                                       title="Supprimer"
                                                                       data-href="{{url('/fiche/'.$fiche->id.'/piece-jointe/'.$piece->id.'/suppression')}}"><i
                                                                                class="icon-trash"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /piece jointe sestion-->
                            </div>
                            <!-- /Section fiche informations-->


                            <!-- Section fiche historique -->
                            <div class="col-lg-3" id="fiche_historique">
                                <button type="button" class="btn-block update_fiche btn btn-primary btn-xs rounded0"><b><i
                                                class="icon-database-refresh"></i></b>&nbsp;&nbsp;&nbsp;Enregistrer
                                </button>
                                <br>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="text-custom-grey text-bold" style="padding-top: 5px;">
                                            Conseiller : </label>
                                        @if(Auth::user()->isRole('admin') || Auth::user()->isRole('supervisor'))
                                            <select name="user_id" id="user_id"
                                                    class="mt-m15 bootstrap-select form-control form-control-sm">
                                                <option value=""></option>
                                                @foreach($users as $user)
                                                    <option @if($fiche->user_id == $user->id) selected
                                                            @endif value="{{$user->id}}">{{$user->nom.' '.$user->prenom}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <input type="text" disabled readonly
                                                   name="user_fullname" id="user_fullname"
                                                   class="mt-m15 form-control"
                                                   value="{{Auth::user()->nom.' '.Auth::user()->prenom}}">

                                            <input type="hidden" name="user_id" id="user_id"
                                                   class="mt-m15 form-control"
                                                   value="{{Auth::user()->id}}">
                                        @endif

                                        <span class="text-danger error-msg" id="error_user_id">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                    </div>
                                </div>

                                <div class="panel panel-flat rounded0 p-10 border-top-lg border-top-primary">
                                    <select class="select   form-control form-control-sm" name="etat_id"
                                            id="etat_id">
                                        @php
                                            {{
                                               $user = \App\User::findOrFail(\Illuminate\Support\Facades\Auth::user()->id);
                                               $userGroupeEtats = $user->role->etat_groupe;
                                               foreach($userGroupeEtats as $userGroupeEtat) {
                                                       if(sizeof($userGroupeEtat->groupe_etat->fiche_etats)>0){
                                                       $listEtats = $userGroupeEtat->groupe_etat->fiche_etats;
                                                       $optionsHtml = '';
                                                           foreach($listEtats as $etat){
                                                           if($fiche->etat_id == $etat->id){
                                                           $optionsHtml.='<option selected value="'.$etat->id.'">'.$etat->libelle.'</option>';
                                                           }else{
                                                              //$optionsHtml.='<option selected value="'.$etat->id.'">'.$etat->libelle.'</option>';
                                                           $optionsHtml.='<option  value="'.$etat->id.'">'.$etat->libelle.'</option>';
                                                           }
                                                           //$etatsHtml.='<li><a href="'.url("fiches/etat"). '/' . $etat->id .'"><span><span class="badge bg-teal-400 pull-right">'.$etat->countFiches($etat->id).'</span> </span>'.$etat->libelle.'</a></li>';
                                                           }
                                                           echo '<optgroup label="'.$userGroupeEtat->groupe_etat->valeur.'">
                                                                                   '.$optionsHtml.'
                                                                 </optgroup>';
                                                       }
                                               }
                                            }}
                                        @endphp
                                    </select>
                                    <div class="form-group mt-3 mb0">
                                        &nbsp;

                                        <div id="date_rappel_div"
                                             class="@if(is_null($fiche->date_rappel)) custom-hidden @endif">
                                            <label for="date_rappel" class="text-custom-grey text-bold mt-m12">
                                                Date Rappel
                                            </label>
                                            <input type="datetime-local" name="date_rappel" id="date_rappel"
                                                   class="mt-m15 form-control"
                                                   @if(!is_null($fiche->date_rappel))
                                                   value="{{date('Y-m-d\TH:i',strtotime(str_replace('-','/',$fiche->date_rappel)))}}"
                                                   @else value="" @endif>
                                            <span class="text-danger error-msg" id="error_date_rappel">
                           <strong class="text-danger"></strong>
                           </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-flat border-top-lg border-top-primary">
                                    <div class="breadcrumb-line ">
                       <span class=" breadcrumb text-bold"><i
                                   class="icon-file-empty2 position-left"></i>Fiche Historique</span>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a data-action="collapse"></a></li>
                                                <li><a data-action="reload"></a></li>
                                                <!--<li><a class="close-fiche-historique"><i class="icon-cross"></i></a></li>-->
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body p-10" id="fiche_historique_body">
                                        @foreach($fiche->historique as $historique)

                                            @if($historique->action_id === 13 && Auth::user()->isRole('agent'))

                                            @else
                                                @if(empty($historique->description))
                                                    <ul class="media-list">
                                                        <li class="media">
                                                            <div class="media-left pr-5"><a href="#"
                                                                                            class="btn border-primary text-primary btn-flat btn-icon btn-sm"><i
                                                                            class="icon-file-text3"></i></a></div>
                                                            <div class="media-body">
                                                                <a href="#">{{ $historique->action->action }}</a>
                                                                @if($historique->user != null)
                                                                    <div class="text-size-base media-annotation ">{{ $historique->created_at->format('d/m/Y H:i') . ' ' . $historique->user->prenom . " " . $historique->user->nom }}</div>
                                                                @else
                                                                    <div class="text-size-base media-annotation">{{ $historique->created_at->format('d/m/Y H:i') . ' Client'}}</div>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    </ul>
                                                @else
                                                    @php
                                                        $historique->description=explode('<br>',$historique->description);$hist="";
                                                        foreach ($historique->description as $desc)
                                                        $hist .= "<p>".$desc."</p>";
                                                    @endphp

                                                    <ul class="media-list chat-list">
                                                        <li class="media">
                                                            <div class="media-left">
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-content media-content-1 bg-blue-400 ">@php echo $hist ;@endphp
                                                                </div>
                                                                @if($historique->user != null)
                                                                    <span class="media-annotation display-block">{{ $historique->created_at->format('d/m/Y H:i') . ' ' . $historique->user->prenom . " " . $historique->user->nom }}</span>
                                                                @else
                                                                    <span class="media-annotation display-block">{{ $historique->created_at->format('d/m/Y H:i') . ' Client'}}</span>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    </ul>
                                                @endif
                                            @endif
                                        <!--<li class="media reversed">
                                       <div class="media-body">
                                           <div class="media-content">Satisfactorily strenuously while
                                               sleazily
                                           </div>
                                           <span class="media-annotation display-block mt-10">2 hours ago</span>
                                       </div>

                                       <div class="media-right">

                                       </div>
                           </li>-->
                                        @endforeach

                                    </div>
                                    <div class="panel-body p-10">
                       <textarea placeholder="Commentaire" class="form-control" name="commentaire"
                                 id="commentaire"></textarea>
                                    </div>
                                </div>


                            </div>
                            <!-- /Section fiche historique -->
                        </div>


                        <!-- section tarificateur -->
                        <div class="col-md-12 bg-grey-700">
                            <div class="col-md-12">
                                <div class="panel panel-flat border-top-lg border-top-primary">
                                    <div class="breadcrumb-line bg-light">
                       <span class=" breadcrumb text-bold"><i
                                   class="icon-coins text-size-large position-left"></i>Tarificateur</span>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li class="float-right"><a data-action="collapse"
                                                                           class="rotate-180"></a>
                                                </li>

                                                <ul class="breadcrumb-elements float-left">
                                                    <li>

                                                        <button id="setTarifValues" type="button"
                                                                class="btn rounded0 btn-info btn-xs mt-m9"><b><i
                                                                        class="icon-coin-euro "></i></b>Tarificateur
                                                        </button>

                                                    </li>
                                                </ul>

                                                <!--
                                                <li><a data-action="reload"></a></li>
                                                <li><a class="close-fiche-historique"><i class="icon-cross"></i></a>
                                                </li>
                                                -->
                                            </ul>

                                        </div>
                                    </div>
                                    <div class="panel-body p-10"> <!-- hide TarifiocateurDiv style="display: none;"-->

                                        <div class="col-md-12">
                                            <div class="tabbable">
                                                <input type="hidden" id="type-assurance-id" value="1">
                                                <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                                                    <?php $i = 1;?>

                                                    @foreach($types_assurance as $type_assurance)
                                                        <li class="@if($i==1) active @endif type-assurance-tab"
                                                            data-id="{{$type_assurance->id}}">
                                                            <a href="#highlighted-justified-tab{{$i}}"
                                                               data-toggle="tab">{{$type_assurance->nom}}</a>
                                                        </li>
                                                        <?php $i++?>
                                                    @endforeach
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane active treeview treeview-checkbox-demo-{{$type_assurance->id}}"
                                                         id="highlighted-justified-tab{{$i}}">

                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="getTarifValues" id="getTarifValues">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /section tarificateur-->

                        <!-- Footer -->
                    @include('includes.footer')
                    <!-- /footer -->
                    </div>
                    <!-- /content area -->
                </div>
                <!-- /main content -->
            </form>

        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->

    <!-- piece jointe modal-->
    @include('includes.piece-jointe' ,['type' => "fiche",'type_id'=>$fiche->id])
    <!-- /piece jointe

    <!-- modal mail-->
    <div id="modal_mail" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    </div>
    <!-- /modal mail-->


    <!-- modal sms-->
    @include('sms.sms-modal')
    <!-- /modal sms-->

    <!-- modal sms-->
    @include('includes.password-generation')
    <!-- /modal sms-->

    @include('includes.tarificateur.tarificateur-modal')

    @php
        \App\Historique::create(['user_id' => Auth::user()->getAuthIdentifier(),'description'=>'Consultation fiche', 'fiche_id' => $fiche->id, 'action_id' => 13, 'vue' => FALSE]);
    @endphp

@endsection


