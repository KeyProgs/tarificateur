<!-- Main sidebar -->
@php
    //use App\Http\Controllers\MailController;
    //$oClient = MailController::openImapConnection();
    \Illuminate\Support\Facades\Session::get('Imap_Folders');
@endphp
@if(Session::has('message-email'))
    <div class="alert {{ Session::get('alert-class-email', 'alert-info') }} alert-styled-left alert-arrow-left alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                    class="sr-only">Close</span></button>
        <span class="text-semibold"> {{ Session::get('message_email ') }} .</span>
    </div>
@endif
<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="category-content">
                <div class="sidebar-user-material-content">
                    <a href="#"><img src="/uploads/img/agents/{{Auth::user()->email}}.jpg"
                                     class="img-circle img-responsive" alt=""></a>
                    <!--<div class="panel panel-flat rounded0 bg0">
                        <div class="panel-body">
                            <div class="chart has-fixed-height has-minimum-width" id="pie_multiples"
                                 style="height: 130px;"></div>
                        </div>
                    </div>-->
                    <h6>{{Auth::user()->nom}}  {{Auth::user()->prenom}}</h6>
                    <span class="text-size-small"></span>
                </div>

                <div class="sidebar-user-material-menu">
                    <a href="#user-nav" data-toggle="collapse"><span>Mon compte</span> <i class="caret"></i></a>
                </div>
            </div>

            <div class="navigation-wrapper collapse" id="user-nav">
                <ul class="navigation">
                    <li><a href="{{url('/mon-profile')}}"><i class="icon-user-plus"></i> <span>Mom Profil</span></a>
                    </li>
                    <li><a href="#"><i class="icon-coins"></i> <span>Chiffre d'affaire</span></a></li>
                    <li><a href="#"><i class="icon-comment-discussion"></i> <span><span
                                        class="badge bg-teal-400 pull-right">58</span> Messages</span></a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-cog5"></i> <span>paramètres de compte</span></a></li>
                    <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                    class="icon-switch2"></i> <span>Déconnexion</span></a></li>
                </ul>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">

            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">


                    <!-- Main Menu test-->
                    <li class="navigation-header">
                        <span>Menu</span>


                    </li>

                    @php
                        {{
                        $ficheEtats = \App\Fiche_etat::all();
                        $user = \App\User::findOrFail(\Illuminate\Support\Facades\Auth::user()->id);
                        }}
                    @endphp
                    <li>
                        <a href=""><i class="icon-server active"></i> <span>Serveur Predictif</span></a>
                        <ul>
                            <li><a href="{{url('/predictif/agent')}}"><i class="icon-phone-outgoing active"></i> <span>Appels Predictif </span></a>
                            </li>
                            @if(Auth::user()->role->level > 1)
                                <li><a href="#"><i class="icon-mail-read active"></i> <span>Suppervision</span></a>
                                    <ul>

                                        <li><a href=""><i class="icon-mail5 active"></i>
                                                <span>Ecoutes à chaud</span></a>
                                        </li>
                                        <li><a href="{{url('predictif/ecoute-a-froid')}}"><i class="icon-mail5 active"></i>
                                                <span>Ecoutes à froid</span></a>
                                        </li>

                                    </ul>
                                </li>

                            @endif
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-bubble-notification active"></i> <span>Gestion Mails</span></a>
                        <ul>
                            <li><a href="{{url('/mail/nouveau')}}"><i class="icon-mail5 active"></i>
                                    <span>Nouveau Email</span></a></li>
                            <li><a href="#"><i class="icon-mail-read active"></i> <span>Boite de récéption</span></a>
                                <ul>
                                    @if(\Illuminate\Support\Facades\Session::get('Imap_Folders')!=null)
                                        @php $Folders = \Illuminate\Support\Facades\Session::get('Imap_Folders') @endphp
                                        @foreach($Folders as $folder)
                                            <li><a href="{{url('/mails/'.$folder->name)}}"><i
                                                            class="icon-mail5 active"></i>
                                                    <span>{{$folder->name}}</span></a></li>
                                            @php $subFolder = $folder->children @endphp
                                            @foreach($subFolder as $sf)
                                                <li>
                                                    <a href="{{url('mails/'.$folder->name.'.'.$sf->name)}}"><i
                                                                class="icon-twitter"></i> <span>{{$sf->name}}</span></a>
                                                </li>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </ul>
                            </li>


                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-cube3 active"></i> <span>Portefeuille client</span></a>

                        <ul>
                            <li class="">
                                <a href="{{url('fiches/nouvelle-fiche')}}"
                                   class="custom-link-sidebar text-uppercase"><i class="icon-plus-circle2"></i> <span> Créer une fiche</span></a>
                            </li>
                            @php
                                {{
                                   $userGroupeEtats = $user->role->etat_groupe;
                                   $i = 0;
                                   $class="";
                                   foreach($userGroupeEtats as $userGroupeEtat) {
                                          $i++;
                                           if($i>1){
                                                 $class="";
                                           }
                                           if(sizeof($userGroupeEtat->groupe_etat->fiche_etats)>0){
                                           $listEtats = $userGroupeEtat->groupe_etat->fiche_etats;
                                           $etatsHtml = '';
                                               foreach($listEtats as $etat){
                                               $etatsHtml.='<li><a href="'.url("fiches/etat"). '/' . $etat->id .'"><span><span class="badge bg-teal-400 pull-right">'.$etat->count($etat->id).'</span> </span>'.$etat->libelle.'</a></li>';
                                               }
                                               echo '<li class="'.$class.'">
                                                        <a href="#"><span><span class="badge bg-warning-400 pull-right">'.$userGroupeEtat->groupe_etat->count().'</span> </span>'.$userGroupeEtat->groupe_etat->valeur.'</a>
                                                        <ul >
                                                            '.$etatsHtml.'
                                                        </ul>
                                                     </li>';
                                           }

                                   }
                                }}
                            @endphp
                        </ul>
                    </li>
                    <li class="{{ request()->is('gestion-devis') ? 'active' : '' }}">
                        <a href="{{url('/gestion-devis')}}"><i class="icon-coin-euro"></i>
                            <span>Gestion Devis</span></a>
                    </li>


                    @if($user->isRole("admin") || $user->isRole("supervisor"))
                        <li>
                            <a href="#">
                                <i class="icon-user-check"></i>
                                <span>Administration</span>
                            </a>
                            <ul class="hidden-ul">


                                <li>
                                    <a href="#"><i class="icon-lock5"></i>Admin Collaborateurs</a>
                                    <ul class="">
                                        <li class="{{ request()->is('equipes') ? 'active' : '' }}">
                                            <a href="{{url('/equipes')}}"><i class="icon-list2"></i>
                                                <span>Liste des équipes</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>


                                <li class="{{ request()->is('admin/fiches') ? 'active' : '' }}">
                                    <a href="{{url('/admin/fiches')}}"><i class="icon-database"></i>
                                        <span>manager portefeuille</span></a>
                                </li>
                                <li class="{{ request()->is('gestion-contrats') ? 'active' : '' }}">
                                    <a href="{{url('/gestion-contrats')}}"><i class="icon-clipboard3"></i>
                                        <span>Gestion Contrats</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-cog3"></i>Paramètres système</a>
                                    <ul class="">

                                        <li class="{{ request()->is('compagnies') ? 'active' : '' }}">
                                            <a href="#"><i class="icon-city"></i>Gestion Compagnies</a>
                                            <ul class="">
                                                <li class="{{ request()->is('compagnies') ? 'active' : '' }}">
                                                    <a href="{{url('/compagnies')}}"><i class="icon-list2"></i>
                                                        <span>Liste Compagnies</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="{{ request()->is('/volets') ? 'active' : '' }}">
                                            <a href="{{url('/volets')}}"><i class="icon-tree5"></i>
                                                <span>Postes remboursement</span></a>
                                        </li>

                                        <li class="{{ request()->is('/regimes') ? 'active' : '' }}">
                                            <a href="{{url('/regimes')}}"><i class="icon-drawer2"></i>
                                                <span>Régimes</span>
                                            </a>
                                        </li>

                                        <li class="{{ request()->is('/groupes-etats') ? 'active' : '' }}">
                                            <a href="{{url('/groupes-etats')}}"><i class="icon-make-group"></i>
                                                <span>Codifications</span></a>
                                        </li>

                                        <li class="">
                                            <a href="#"><i class="icon-stamp"></i> <span>Fournisseurs</span></a>
                                        </li>

                                        <li class="{{ request()->is('/templates') ? 'active' : '' }}">
                                            <a href="{{url('/templates')}}"><i class="icon-pen2"></i>
                                                <span>Templates</span>
                                            </a>
                                        </li>

                                        <li class="{{ request()->is('/ip-adresses') ? 'active' : '' }}">
                                            <a href="{{url('/adresses-ip')}}"><i class="icon-code"></i>
                                                <span>Ip Adresses </span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>


                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- /main navigation -->
    </div>
</div>
<!-- /main sidebar -->
