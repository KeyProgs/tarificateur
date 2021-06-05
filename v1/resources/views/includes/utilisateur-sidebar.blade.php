<!-- Main sidebar -->
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


                    <li class=""><a href="{{url('fiches/nouvelle-fiche')}}"
                                    class="custom-link-sidebar text-uppercase"><i class="icon-plus-circle2"></i> <span> Créer une fiche</span></a>
                    </li>

                    <!-- Main Menu-->
                    <li class="navigation-header">
                        <span>Recherche GÉNÉRAL</span>


                    </li>

                    @php
                        {{
                        $ficheEtats = \App\Fiche_etat::all();
                        $user = \App\User::findOrFail(\Illuminate\Support\Facades\Auth::user()->id);
                        }}
                    @endphp

                    <li class="{{ request()->is('fiches/etat/*') ? 'active' : '' }}">
                        <a href="#"><i class="icon-cube3 active"></i> <span>Gestion Fiches</span></a>
                        <ul>
                            @php
                                {{
                                   $userGroupeEtats = $user->role->etat_groupe;
                                   $i = 0;
                                   $class="active";
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
