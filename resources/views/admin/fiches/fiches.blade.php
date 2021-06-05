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
                <div class="page-header page-header-default">


                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="{{url('/fiches/etat/1')}}"><i class="icon-home2 position-left"></i> Accueil
                                </a></li>
                            <li class="active">Gestion des fiches</li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li>
                                <input type="search" class="form-control" placeholder="N° Télephone">
                            </li>
                            <li>
                                <a href="#"><i class="icon-phone2 position-left"></i>Appeler</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-alarm position-left"></i> Rappels <span class="caret"></span>
                                </a>
                                @php
                                    $ef = new \App\Fiche_etat();
                                @endphp
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{url('/fiches/etat/21/-1')}}">
                                            <span><span class="badge bg-teal-400 pull-right">{{$ef->count(21,-1)}}</span> </span>
                                            Rappels en retard
                                        </a>
                                    </li>
                                    <li><a href="{{url('/fiches/etat/21/0')}}">
                                            <span><span class="badge bg-teal-400 pull-right">{{$ef->count(21,0)}}</span> </span>
                                            Rapples
                                            du jour</a></li>
                                    <li><a href="{{url('/fiches/etat/21/1')}}">
                                            <span><span class="badge bg-teal-400 pull-right">{{$ef->count(21,1)}}</span> </span>
                                            Rappeles programmés</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{url('/fiches/etat/21')}}">
                                            Tout Les Rappels</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->

                <!-- Content area -->
                <div class="content p0">
                    <div class="col-md-12">
                        <!--section liste des fiches-->
                        <div class="col-lg-12" id="fiches-div">
                            <div class="row">
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <div class="input-group col-md-4">
                                                <input type="text" id="search-text" class="form-control"
                                                       placeholder="Rechercher">
                                                <span class="input-group-btn">
													<button id="search-btn" class="btn btn-primary btn-sm rounded0"
                                                            type="button"> Trouver
                                                    </button>
											    </span>
                                            </div>
                                            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                                        </div>
                                        <div class="heading-elements">
                                            <form class="heading-form" action="#">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="text-bold control-label pt-10">
                                                                Action : &nbsp;&nbsp;
                                                            </label>
                                                            <select class="form-control" style="float: right;"
                                                                    id="action">
                                                                <option value="" selected></option>
                                                                <option value="1">Réaffécter</option>
                                                                <option value="2">changer Status</option>
                                                                <option value="3">Supprimer</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>

                                            <ul class="icons-list">
                                                <li><a data-action="collapse"></a></li>
                                                <!--<li><a data-action="reload"></a></li>
                                                <li><a data-action="close"></a></li>-->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="p-10"><b>Selectionner Tous &nbsp;</b><input type="checkbox"
                                                                                            class="select-all-fiches">
                                    </div>

                                    <div id="table-fiches-body">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/section liste des fiches-->

                        <!-- Section fiche historique -->
                        <div class="col-lg-3" id="fiche_historique">

                        </div>
                        <!-- /section fiche historique -->
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



    <!--  Actions modal -->
    <div id="actions-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"></h5>
                </div>

                <form action="#">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-10 col-md-offset-1">
                                    <label for="select-option" id="select-lable-title">Conseiller</label>
                                    <select id="select-option" name="select-option" class="form-control">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-10 col-md-offset-1">
                            <span class="text-danger" id="error-msg">

                            </span>
                        </div>
                        <div id="response-msg">

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link rounded0" data-dismiss="modal">Fermer</button>
                        <button type="button" id="apply-btn" class="btn btn-primary rounded0">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Actions modal-->
    <script type="text/javascript">


        $(document).ready(function () {
            //checkbox event action
            var checkedFiches = [];
            $('#fiches-div').on('change', '.fiche-checkbox', function () {
                if (this.checked) {
                    checkedFiches.push(this.id);
                } else {
                    var searchValue = this.id;
                    checkedFiches = $(checkedFiches).not([searchValue]).get();
                }

            });


            $('#fiches-div').on('change', '.select-all-fiches', function () {
                if (this.checked) {
                    //$(".fiche-checkbox").prop('checked', true);
                    $(".fiche-checkbox").each(function () {
                        var checkBox = $(this);
                        //if (jQuery.inArray(checkBox.attr('id'), checkedFiches) != -1) {
                        checkBox.prop('checked', true);
                        checkedFiches.push(this.id);
                        //}
                    });
                } else {
                   // $(".fiche-checkbox").prop('checked', false);
                    $(".fiche-checkbox").each(function () {
                        var checkBox = $(this);
                        //if (jQuery.inArray(checkBox.attr('id'), checkedFiches) != -1) {
                        checkBox.prop('checked', false);
                        checkedFiches = $(checkedFiches).not([this.id]).get();
                        //}
                    });
                }
            });


            //set checkbox checked
            function setChecked() {
                $(".fiche-checkbox").each(function () {
                    var checkBox = $(this);
                    if (jQuery.inArray(checkBox.attr('id'), checkedFiches) != -1) {
                        checkBox.prop('checked', true);
                    }
                });
            }

            //call get liste fiches function
            function getFichesData() {
                var input1 = $('#search-text').val();
                $.ajax({
                    url: app_url + "/table-fiches/",
                    type: "GET",
                    data: {'input1': input1},
                    cache: false,
                    success: function (data) {
                        if (data) {
                            var tableFichesBody = $('#table-fiches-body');
                            tableFichesBody.html('');
                            tableFichesBody.append(data);
                            setChecked();
                        }
                    },
                    error: function () {
                        alert(' Une erreur est survenue dans le script de cette page !')
                    }
                });
            }

            getFichesData();
            //onclick pagination link append data
            $('#fiches-div').on('click', '.page-link', function () {

                if ($(this).attr("href")) {
                    var baseUrl = $(this).attr('href');
                    baseUrl = baseUrl.replace("//table", "/table");
                    var input1 = $('#search-text').val();
                    $.ajax({
                        url: baseUrl,
                        type: "GET",
                        data: {'input1': input1},
                        cache: false,
                        success: function (data) {
                            if (data) {
                                var tableFichesBody = $('#table-fiches-body');
                                tableFichesBody.html('');
                                tableFichesBody.append(data);
                                setChecked();
                            }
                        },
                        error: function () {
                            alert(' Une erreur est survenue dans le script de cette page !')
                        }
                    });
                    return false;
                }
            });

            //search btn event
            $("#search-btn").on('click', function () {
                getFichesData();
            });
            //search btn event using enter key
            $('#search-text').keypress(function (e) {
                var key = e.which;
                if (key == 13) {
                    getFichesData();
                }
            });

            //get action from select
            $('#action').on('change', function () {
                var modalTitle;
                var selectTitle;
                $('#error-msg').html('');
                $('#response-msg').html('');
                var ajaxUrl;
                if (this.value == 1) {
                    ajaxUrl = '{{ url('/get-users-by-role')}}';
                    modalTitle = 'Affectation des fiches';
                    selectTitle = 'Conseiller';
                }
                if (this.value == 2) {
                    ajaxUrl = '{{ url('/get-etats-fiches')}}';
                    modalTitle = "Changement d'Etat";
                    selectTitle = 'Fiches Etats';
                }
                $.ajax({
                    type: "GET",
                    url: ajaxUrl,
                    //data: {'_token': _token, 'id': fiche_id},
                    cache: false,
                    success: function (data) {
                        if (data.success) {
                            $('#select-option').html('');
                            $('#select-option').append(data.data);
                        } else {
                            alert(' Une erreur est survenue dans le script de cette page !')
                        }
                    },
                    error: function () {
                        alert(' Une erreur est survenue dans le script de cette page !')
                    }
                });

                $('.modal-title').html(modalTitle);
                $('#select-lable-title').html(selectTitle);
                $('#actions-modal').modal('show');

            });


            $('#apply-btn').on('click', function () {


                var option = $('#action option:selected').val();

                if (option == 1) {
                    ajaxUrl = '{{ url('/reaffect-fiches')}}';
                }
                if (option == 2) {
                    ajaxUrl = '{{ url('/change-etats-fiches')}}';
                }
                $('#error-msg').html('');
                $('#response-msg').html('');

                var conseiller = $('#select-option option:selected').val();
                var errors = '';
                if (conseiller === "") {
                    errors += ' <strong class="text-danger">- Vous devez selectionner un conseiller</strong><br>'
                }
                if (checkedFiches.length === 0) {
                    errors += ' <strong class="text-danger">- Vous devez selectionner des fiches</strong><br>'
                }
                if (errors != '') {
                    $('#error-msg').append(errors);
                } else {
                    $.ajax({
                        type: "POST",
                        url: ajaxUrl,
                        data: {'_token': _token, 'conseiller': conseiller, 'fiches': checkedFiches},
                        cache: false,
                        success: function (data) {
                            if (data.success) {
                                $('#response-msg').append('<div class="alert alert-primary rounded0 alert-styled-left alert-arrow-left alert-bordered">\n' +
                                    '                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span\n' +
                                    '                                        class="sr-only">Close</span></button>\n' +
                                    '                            <span class="text-semibold"> ' + data.message + '.</span>\n' +
                                    '                      </div>');
                                checkedFiches = [];
                                getFichesData();
                            } else {
                                alert(' Une erreur est survenue dans le script de cette page !')
                            }
                        },
                        error: function () {
                            alert(' Une erreur est survenue dans le script de cette page !')
                        }
                    });
                }
            })
        });
    </script>
@endsection







