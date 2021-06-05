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
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4>
                                <i class="icon-files-empty position-left"></i>
                                <span class="text-semibold">Gestion des Régles </span> -
                            </h4>
                        </div>
                        @include('includes.utilisateur-page-header')
                    </div>

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="{{url('/fiches/etat/1')}}"><i class="icon-home2 position-left"></i> Regles
                                </a></li>
                            <li class="active"> Gestion des regels de calcule</li>
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
                <div class="content p0">
                    <div class="col-md-12">

                        <!-- -->
                        {!! Form::open(['action' => 'TarificateurController@regles' , 'method' => 'post' ]); !!}

                        @csrf
                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail1">Année :</label>
                            <input required ="text" class="form-control" name="annee" id="annee" placeholder="L'année"
                                   value="2019">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail1">max_age :</label>
                            <input type="text" class="form-control" name="max_age" id="max_age" placeholder="Age Max"
                                   value="{{$Gamme->max_age}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail1">min_age :</label>
                            <input type="text" class="form-control" name="min_age" id="min_age" placeholder="Age Min"
                                   value="{{$Gamme->min_age}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail1">e_age :</label>
                            <input type="text" class="form-control" name="e_age" id="e_age" placeholder="Enfant Max Age"
                                   value="{{$Gamme->e_age}}">
                        </div>
                        <input type="hidden" name="gamme_id" id="gamme_id" value="{{$Gamme->id}}">
                        <input type="hidden" name="zone_id" id="zone_id" value="{{$zone_id}}">

                        @php
                            //dd($Regime_Regles)
                        @endphp
                        <div lass="panel-body col-md-12 ">
                            <div class="panel panel-flat col-md-5">
                                <div class="panel panel-flat col-md-12">Départements associés</div>
                                <select name="Departement_regles[]" multiple="multiple" class="form-control listbox"
                                        style="display: none;">
                                    @foreach ($Departements as $Departement)
                                        //data-sortindex="5"
                                        //data-sortindex="2"

                                        <option value="{{$Departement->id}}"
                                                data-sortindex="{{$Departement->id}}">{{$Departement->code}}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="ZoneName" value="{{$zone->zone}}"
                                       placeholder="Nom de la Zone"/>

                                @php   $dep=null;   @endphp
                                @if (sizeof($Departement_zones) >0)
                                    @foreach( $Departement_zones as $departement_zone)
                                        @php   $dep=$dep . "\n". $departement_zone->code;  @endphp
                                    @endforeach
                                @endif
                                <textarea class="form-control" rows="5" name="Departement_regles"
                                          id="Departement_regles">
                                 {{$dep}}</textarea>
                            </div>
                            <div class=" col-md-2"></div>
                            <div class="panel panel-flat col-md-5">
                                <div class="panel panel-flat col-md-12">Régimes associés</div>
                                <select name="Regime_regles[]" multiple="multiple" class="form-control listbox"
                                        style="display: none;">
                                    @foreach ($Regimes as $regime)
                                        //data-sortindex="5"
                                        //data-sortindex="2"

                                        <option value="{{$regime->id}}"
                                                data-sortindex="{{$regime->id}}">{{$regime->libelle}}</option>
                                    @endforeach
                                </select>
                                @php   $reg=null;   @endphp
                                @if (@sizeof($Regime_Regles) >0)
                                    @foreach( $Regime_Regles as $Regime_Regle)
                                        @php   $reg=$reg . "\n". $Regime_Regle->valeur;  @endphp
                                    @endforeach
                                @endif
                                 <!--<textarea class="form-control" rows="5" name="Regime_regles_"
                                          id="Regime_regles">
                                 </textarea>-->
                            </div>
                        </div>


                        Année : <br>
                        @for($Age = $Gamme->min_age ; $Age <= $Gamme->max_age; $Age++)
                            <table class="table table-hover">
                                <tr>
                                    <th scope="row">Ages</th>
                                    @foreach ($Formules as $Formule)
                                        <th>
                                            {{ $Formule->nom }}
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" name="F{{$Formule->id}}"
                                                          id="F{{$Formule->id}}">
                                                </textarea>
                                                <button type="button" onclick="calculer('F{{$Formule->id}}')"
                                                        id="C{{$Formule->id}}" value="F{{$Formule->id}}">calculer
                                                </button>
                                            </div>
                                        </th>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td> Enfant < {{$Gamme->e_age}}</td>
                                    @foreach ($Formules as $Formule)
                                        <td><input type="text" name="F{{$Formule->id}}_A{{$Gamme->e_age}}"
                                                   id="F{{$Formule->id}}_A{{$Gamme->e_age}}"
                                                   value="{{@$Formule->prix[$Gamme->e_age]}}"/>
                                        </td>
                                    @endforeach
                                </tr>
                                @for($Age = $Gamme->min_age ; $Age <= $Gamme->max_age; $Age++)
                                    <tr>
                                        <td>

                                            {{$Age}} ans
                                        </td>
                                        @foreach ($Formules as $Formule)
                                            <td>
                                                <input type="text" name="F{{$Formule->id}}_A{{$Age}}"
                                                       id="F{{$Formule->id}}_A{{$Age}}"
                                                       value="{{$Formule->prix[$Age]}}"/>
                                            </td>
                                        @endforeach
                                    </tr>

                                @endfor
                            </table>
                        @endfor

                        {!! Form::submit('Save !');!!}
                        {!! Form::close() !!}

                        @php


                                @endphp


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

        function calculer(Formule) {
            //$( "#output_div" ).html( $( this ).val().replace('\n', '<br/>') );
            //var Formule = $(this).attr('value');
            var prix = $.trim($("#" + Formule).val()).split("\n");
            var min_age ={{$Gamme->min_age}};

            if (prix != "") {
                // Show alert dialog if value is not blank
                //alert(prix[2]);

                $.each(prix, function (index, value) {
                    // alert(index + ": " + value);
                    $('#' + Formule + '_A' + min_age).attr('value', value);
                    min_age++;
                });
            }
        }


    </script>


@endsection



