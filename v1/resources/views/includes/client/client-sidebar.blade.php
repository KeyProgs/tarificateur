<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="category-content">
                <div class="sidebar-user-material-content">
                    <a href="#"><img src="{{asset('/uploads/img/client/user-icon.png')}}"
                                     class="img-circle img-responsive" alt=""></a>
                    <!--<div class="panel panel-flat rounded0 bg0">
                        <div class="panel-body">
                            <div class="chart has-fixed-height has-minimum-width" id="pie_multiples"
                                 style="height: 130px;"></div>
                        </div>
                    </div>-->
                    <h6>{{Session::get('client')->nom}} {{Session::get('client')->prenom}}</h6>
                    <span class="text-size-small"></span>
                </div>

                <div class="sidebar-user-material-menu">
                    <a href="#user-nav" data-toggle="collapse"><span>Mon compte</span> <i class="caret"></i></a>
                </div>
            </div>

            <div class="navigation-wrapper collapse" id="user-nav">
                <ul class="navigation">
                    <li class="divider"></li>
                    <li><a href="{{route('infos.client')}}"><i class="icon-cog5"></i> <span>paramètres de compte</span></a>
                    </li>
                    <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                     class="icon-switch2"></i> <span>Déconnexion</span></a></li>
                </ul>


                <form id="logout-form" action="{{ route('logout.client') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">

            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <li class="{{ request()->is('*.client/demande') ? 'active' : '' }}">
                        <a href="{{url('/espace-client/demande')}}"><i class="icon-file-empty2"></i>
                            <span>Ma demande</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('*.client/devis') ? 'active' : '' }}">
                        <a href="{{url('/espace-client/devis')}}"><i class="icon-list"></i>
                            <span>Liste devis</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->
    </div>
</div>
<!-- /main sidebar -->
