@extends('layouts.utilisateur')

@section('content')


    <script src="{{asset('global-assets/js/plugins/forms/inputs/duallistbox.min.js')}}"></script>
    <script src="{{asset('global-assets/js/demo_pages/form_dual_listboxes.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/ui/ripple.min.js')}}"></script>






    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
        @include('includes.utilisateur-sidebar')
        <!-- Main content -->
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header page-header-default">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="{{url('/fiches/etat/1')}}"><i class="icon-home2 position-left"></i> Gammes
                                </a></li>
                            <li class="active"> Gestion des garanties de calcule</li>
                        </ul>

                        <ul class="breadcrumb-elements">
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
                <div class="content p0">
                    <div class="col-md-12">

                        {!! Form::open(['action' => 'TarificateurController@updateValeurs' , 'method' => 'post' ]); !!}
                        <input type="hidden" name="gamme_id" id="gamme_id" value="{{$gamme_id}}">
                        <table border="1">
                            <tr>
                                <td>Postes</td>
                                @foreach($Formules as $Formule)
                                    <td>{{$Formule->nom}}</td>
                                @endforeach
                            </tr>

                            @foreach($Valeurs as $key => $valeur)
                                <tr>
                                    <td colspan="{{sizeof($Formules)}}"><b>{{$key}}</b></td>
                                </tr>

                                @foreach($valeur as $key => $SousVolet)
                                    <tr>
                                        <td>{{$SousVolet->valeur}}</td>
                                        @foreach($Formules as $Formule)
                                               @php  $gar=null; $desc=null; @endphp
                                            @foreach($Formule->valeurs as $valeur)
                                                @if($valeur->sous_volet_id == $SousVolet->id)
                                                    @php
                                                        $gar=$valeur->valeur;$description=$valeur->description;
                                                    @endphp

                                                @endif
                                            @endforeach
                                            <td>
                                                <input id="F{{$Formule->id}}_SV{{$SousVolet->id}}"
                                                       name="F{{$Formule->id}}_SV{{$SousVolet->id}}" type="text"
                                                       value="{{$gar}}"/>
                                                <br>*<input id="DescF{{$Formule->id}}_SV{{$SousVolet->id}}"
                                                            name="DescF{{$Formule->id}}_SV{{$SousVolet->id}}"
                                                            type="text"
                                                            value="{{@$description}}"/>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach

                            @endforeach

                        </table>

                        {!! Form::submit('Save !');!!}
                        {!! Form::close() !!}


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


    <script>


    </script>


@endsection



