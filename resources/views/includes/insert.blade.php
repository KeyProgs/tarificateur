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


                <div class="content p0 ">
                    <div class="col-md-12">
                        <form method="POST" action="{{@route('Insert_csv_action')}}">
                            @csrf


                            <table class="table-active table-bordered">
                                <tr >
                                    <td> Variable D'envirenement</td>
                                    <td> Champ Correspondant  </td>
                                </tr>
                                @foreach($data as $key => $champ)

                                    <tr>
                                        <td>
                                            {{$champ}}
                                        </td>
                                        <td>
                                            <select name="{{$key}}">
                                                @foreach($Colonnes as $key2 => $colonne)
                                                    <option value="{{$key2}}">{{$colonne}}</option>
                                                @endforeach
                                                    <option value="..." selected> Selectionnez ...</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <input type="submit" value="Ajouter la fiche">
                        </form>
                    </div>
                </div>

            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->



@endsection