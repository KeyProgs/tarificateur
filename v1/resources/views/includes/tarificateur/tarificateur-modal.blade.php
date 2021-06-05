<!-- tarificateur modal -->
<div id="modal_default" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" style="width: 90% !important;">
        <div class="modal-content rounded0">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Tarificateur </h5>
            </div>

            <div class="modal-body">
                <button id="add-item" class="hidden"> Append to div</button>
                <div class="col-md-12">
                    <div class="col-md-3 p0">

                    </div>
                    <div class="col-md-9 p-20">

                    </div>
                    <div class="col-md-3 p0">
                        <div class="pricing-table">
                            <div class="item" style="margin-right: 10px;">
                                <div class="panel text-center rounded0">
                                    <div class="panel-body p0">
                                        <div class="formule-infos">

                                        </div>
                                        <ul class="sous-volet-menu list-unstyled content-group">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="mixedSlider" class="p0 col-md-9 resource-slider">
                        <div class="MS-content pricing-table" id="MS-content">

                        </div>
                        <div class="MS-controls">
                            <button class="MS-left"><i style="font-size: 40px;" class="icon-arrow-left15"
                                                       aria-hidden="true"></i></button>
                            <button class="MS-right"><i style="font-size: 40px;" class="icon-arrow-right15"
                                                        aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="rounded0 btn btn-link" data-dismiss="modal">Fermer</button>
                <button type="button" class="rounded0 btn btn-primary">Enregistrer</button>


            </div>
        </div>
    </div>
</div>
<!-- /tarificateur modal -->


<!-- modal paiement-->
<div id="modal_paiement" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false"
     style="z-index: 999999;">
</div>
<!-- /modal paiement-->

<!-- modal resiliation-->
<div id="modal_resiliation" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
</div>
<!-- /modal resiliation-->

<!-- contrat modal-->
<div id="modal_contrat" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div id="modal_contrat_dialog" class="modal-dialog modal-sm mt-15" style="width: 80%">

    </div>
</div>
<!-- /contrat modal-->


<script src="{{asset('global-assets/js/plugins/multislider/multislider.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        //afiicher les erreurs de validation
        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            var firstError = null;
            $.each(msg, function (key, value) {
                $("#error_" + key).find("strong").append('- ' + value + '<br>')
                //scroll to first error
                if (firstError == null) {
                    firstError = "error_" + key
                }
            });
            //scroll to first error
            $('html, body').animate({
                scrollTop: $("#" + firstError).offset().top - 60
            }, 500);
        }


        //checkbox treeview js
        /*$('.treeview').treeview({
            debug: true,
            data: ,
        });*/
        //multislider js
        $('#mixedSlider').multislider({
            duration: 0,
            interval: 0
        });


        //------------------------------------ Tarificateur modal js ------------------------------

        //height tableau referance
        var tableauRef = {
            formuleIdHeight: 0,
            formuleNomHeight: 0,
            formuleDescritionHeight: 0,
            formuleGammeHeight: 0,
            formuleInfosHeight: 0,
        };

        //changer height tarificateur modal
        function getHeights(listeFormules) {
            var counter = 0;
            $.each(listeFormules['volets'], function (voletKey, voletValue) {
                counter++;
                var vHeight = $('.v_' + counter).height();
                tableauRef['v_' + counter] = vHeight;
                $.each(voletValue, function (sousVoletKey, sousVoletValue) {
                    var svHeight = $('.sv_' + sousVoletValue['id']).height();
                    tableauRef['sv_' + sousVoletValue['id']] = svHeight;
                });
            });
            var counter = 0;
            $.each(listeFormules['volets'], function (voletKey, voletValue) {
                counter++;
                // var vHeight = $('.v_' + counter).height() = tableauRef['v_'+counter];
                $('.v_' + counter).attr('style', 'height: ' + tableauRef['v_' + counter] + 'px !important; padding-bottom: 25px !important;');
                $.each(voletValue, function (sousVoletKey, sousVoletValue) {

                    $('.sv_' + sousVoletValue['id']).attr('style', 'height: ' + tableauRef['sv_' + sousVoletValue['id']] + 'px !important;padding-bottom: 25px !important;');

                    //var svHeight = $('.sv_'+sousVoletValue['id']).height() tableauRef['sv_'+sousVoletValue['id']];
                });
            });
            var divInfosH = $('.formule-infosx').height();
            $('.formule-infos').attr('style', 'height: ' + divInfosH + 'px !important;');
            $('.formule-infosx').attr('style', 'padding-bottom: 0px !important;');


        }

        //load default formules for type assurance sante
        getTypeAssuranceFormules(1);

        //get formules type assurance by id
        function getTypeAssuranceFormules(id) {
            var fiche_id = $('#fiche_id').val();
            $.ajax({
                url: app_url + "get-type-assurance-formules",
                type: "POST",
                data: {'_token': _token, 'type_assurance_id': id, 'fiche_id': fiche_id},
                cache: false,
                success: function (data) {
                    $('.treeview').html(data)
                }
            });
        }

        //tab type assurance event
        $('.type-assurance-tab').on('click', function () {
            var type_assurance_id = $(this).attr("data-id");
            $('#type-assurance-id').val(type_assurance_id);
            getTypeAssuranceFormules(type_assurance_id);
        });


        //open tarificateur modal
        var volet_menu = '';
        var html_menu = '';
        var listeFormules;


        $("#setTarifValues").click(function () {
            enregistrerFiche();


            var type_assurance_id = $('#type-assurance-id').val();
            var listeFormulesInput = $('#getTarifValues');
            listeFormulesInput.val(
                $('.treeview-checkbox-demo-' + type_assurance_id).treeview('selectedValues')
            );


            var sidebar_menu = '';

            //ajax get liste formules
            $.ajax({
                url: app_url + "get-tarificateur-formules/" + listeFormulesInput.val(),
                type: "POST",
                data: {'_token': _token, 'data': listeFormulesInput.val(), 'type_assurance_id': type_assurance_id},
                cache: false,
                success: function (data) {
                    if( data.success){
                        if (boolrec == true) {
                            listeFormules = data.data;

                            $('#MS-content').html('');


                            var counter = 0;
                            $.each(listeFormules, function (key, value) {
                                if (typeof value['IdFormule'] != null) {
                                    counter++;
                                    var html_menu = '';
                                    //console.log(value);
                                    //console.log(listeFormules);
                                    //if (console.log(Object.keys(value['volets']).length)!=0){
                                    $.each(listeFormules['volets'], function (voletKey, voletValue) {
                                        //console.log("-------------------"+voletValue['valeur']);
                                        html_menu += '<li class="text-uppercase text-center custom-lu-style v_' + counter + '"><strong>' + voletKey + '</strong></li>';
                                        //console.log(voletValue['liste_sous_volet'].length + "-----------");
                                        $.each(voletValue, function (sousVoletKey, sousVoletValue) {
                                            //console.log("-----------"+sousVoletValue["valeur"]);
                                            if (typeof  voletValue != 'undefined') {

                                                //console.log(value['garanties']);
                                                var svid = null;
                                                var gar = null;
                                                $.each(value['garanties'], function (keyGarantie, valGarantie) {
                                                    if (valGarantie != null) {
                                                        //$.each(voletValue, function (sousVoletKey, sousVoletValue) { }
                                                        //console.log('************************');
                                                        //console.log(valGarantie);
                                                        // if (valGarantie.length > 0) { //&& typeof valGarantie!= 'string'
                                                        if (sousVoletValue['id'] == valGarantie['sous_volet_id']) {
                                                            console.log("OOOOOOO  sousVoletValue[id] == valGarantie[sous_volet_id]  OOOOOOO");

                                                            svid = sousVoletValue["id"];
                                                            gar = valGarantie["garantie"];

                                                        }
                                                        /*else {
                                                                                                               console.log("OOOOOOO  sousVoletValue[id] <<<>>>> valGarantie[sous_volet_id]  OOOOOOO");

                                                                                                               gar = sousVoletValue["id"] + ' ! ' + valGarantie['sous_volet_id'];
                                                                                                           }*/
                                                        // }


                                                    }
                                                });
                                                html_menu += '<li class="p-5 text-center sv_' + svid + '"> ' + gar + '. </li>';//sousVoletValue["valeur"]
                                            }
                                        });
                                    });
                                    //}
                                    $('#MS-content').append('<div class="formule item">\n' +
                                        '                            <div class="panel text-center rounded0 mb-5">\n' +
                                        '                                <div class="panel-body p0">\n' +
                                        '                                  <div id="formule-infos-' + value["id"] + '" class="formule-infosx">\n' +
                                        '                                    <h4><img height="50" src="/uploads/img/gammes/' + value['NomGamme'] + '.svg"></h4>\n' +
                                        '                                    <h6 class="text-uppercase"> <span  class="bg-primary-300 rounded-circle pl-20 pr-20">' + value["NomGamme"] + '</span></h6>\n' +
                                        '                                    <h6 class="text-uppercase"><span  class="rounded-circle pl-20 pr-20">' + value["NomFormule"] + '</span></h6>\n' +
                                        '                                    <div id="prix_' + value['IdFormule'] + '" class="pb-10"><br>' + value["IdFormule"] + '/mois</b></div>\n' +
                                        '                                    <input type="hidden" id="prix' + value['IdFormule'] + '" class="pb-10"> -  </input>\n' +
                                        '                                    <br><button data-formule-nom="' + value["NomFormule"] + '" data-formule-id="' + value["IdFormule"] + '" data-gamme-nom="' + value["NomGamme"] + '"  data-compagnie-nom="' + value["NomCompagnie"] + '" class="btn-send-devis btn btn-danger btn-xs rounded0 btn-xs-custom">Envoyez un devis</button>&nbsp;\n' +
                                        '                                    <button  data-href="' + webSiteUrl + 'espace-client/f-{{$fiche->id}}/' + value['IdFormule'] + '" data-formule-id="' + value["IdFormule"] + '" class="btn-souscrire btn btn-primary btn-xs btn-xs-custom rounded0">Souscrire</button>\n' +
                                        '                                  </div>\n' +
                                        '                                    <ul class="sous-volet-menu-' + value["id"] + ' list-unstyled content-group">\n' +
                                        '                                      ' + html_menu + '         \n' +
                                        '                                    </ul>\n' +
                                        '                                </div>\n' +
                                        '                            </div>\n' +
                                        '                        </div>');
                                }


                            });

                            html_menu = '';
                            var counter = 0;
                            $.each(listeFormules['volets'], function (voletKey, voletValue) {
                                counter++;
                                html_menu += '<li class="text-uppercase text-center custom-lu-style v_' + counter + ' "><strong>' + voletKey + '</strong></li>';
                                //console.log(voletValue['liste_sous_volet'].length + "-----------");
                                $.each(voletValue, function (sousVoletKey, sousVoletValue) {
                                    //console.log("-----------"+sousVoletValue["valeur"]);
                                    html_menu += '<li class="p-5 text-center sv_' + sousVoletValue['id'] +
                                        '"><strong>' + sousVoletValue["valeur"] + '</strong></li>';
                                });
                            });
                            $('.sous-volet-menu').html(html_menu);
                            getHeights(listeFormules);


                            ////Tarificateur
                            $.each(listeFormules, function (key, value) {
                                //alert( value['IdFormule']);
                                $vars = {'IdFormule': value['IdFormule'], 'IdFiche': '{{$fiche->id}}'};
                                $.ajax({
                                    url: app_url + "tarifierff/",   // + value['IdFormule'] + "/{{$fiche->id}}"
                                    type: "get",
                                    data: {'data': $vars},//'_token': _token,
                                    cache: false,
                                    success: function (data) {
                                        $("#prix_" + value['IdFormule']).val('test');
                                        if (data.success) {
                                            $GetP = data.data;
                                            $("#prix" + value['IdFormule']).val($GetP);
                                            $("#prix_" + value['IdFormule']).html("<b>" + $GetP + "</b>€/mois");
                                        } else {
                                            //prix = data.data;
                                        }
                                    }
                                });
                            });


                        }
                    }

                }
            });


            if ( boolrec == true) $('#modal_default').modal('show');
            // console.log(listeFormules);
        });


        function getContratInfos(fiche_id, formule_id = null, details = null, has_check_etat) {
            $.ajax({
                url: app_url + "get-contrat-infos",
                type: "POST",
                data: {_token: _token, fiche_id: fiche_id, formule_id: formule_id, has_check_etat: has_check_etat},
                cache: false,
                success: function (data) {
                    $('#modal_contrat_dialog').html(data);
                    $('.bootstrap-select').selectpicker('refresh');
                    if (details != null) {
                        $('.formule-breadcrumb').html("<li><a><i class=\"icon-clipboard3 position-left\"></i>" + details['compagnie_nom'] + "</a></li>\n" +
                            "                                                <li><a href=\"#\">" + details['gamme_nom'] + "</a></li>\n" +
                            "                          <li class=\"active\">" + details['formule_nom'] + "</li>");
                    }
                    $('#modal_contrat').modal('show');
                }
            });
        }

        //click send devis button event
        $('#modal_default').on('click', '.btn-send-devis', function () {
            var formule_nom = $(this).attr('data-formule-nom');
            var gamme_nom = $(this).attr('data-gamme-nom');
            var compagnie_nom = $(this).attr('data-compagnie-nom');
            var formule_id = $(this).attr('data-formule-id');
            var fiche_id = $('#fiche_id').val();
            var details = {
                'formule_nom': formule_nom,
                'gamme_nom': gamme_nom,
                'compagnie_nom': compagnie_nom
            };
            getContratInfos(fiche_id, formule_id, details, false);
        });
        //click souscrire button event
        $('#modal_default').on('click', '.btn-souscrire', function () {
            var fiche_id = $('#fiche_id').val();
            var formule_id = $(this).attr('data-formule-id');

            $.ajax({
                url: app_url + 'souscrire/f-' + fiche_id + '/' + formule_id,
                type: "GET",
                //data: {'fiche_id':fiche_id,'formule_id':formule_id},
                cache: false,
                success: function (data) {
                    if (data.success) {

                        if (data.data != null) {
                            //'/espace-client/verification/f-{fiche_id}/devis-{devis_id}/{formule_id}

                            $(location).attr("href", webSiteUrl + "espace-client/u/{{\Illuminate\Support\Facades\Auth::user()->remember_token}}/f-{{$fiche->id}}/devis-" + data.data + "/" + formule_id);
                        }
                    }
                }
            });

        });


        //-------------------------------------- /Tarificateur modal js--------------------------------


        //call get liste des volets et sous volet
        /*function getVolets(formule_id) {
            formule_id = formule_id || null;
            listeSousVolets = [];
            var VoletsNames = [];
            var html_menu = '';
            var ajaxUrl = app_url + "get-sous-volets";
            if (formule_id !== null) {
                ajaxUrl += '/' + formule_id;
            }
            console.log(ajaxUrl);
            $.ajax({
                url: ajaxUrl,
                type: "GET",
                cache: false,
                success: function (data) {
                    if (data.success) {
                        listeSousVolets = data.data;
                        $.each(listeSousVolets, function (key, value) {
                            if (jQuery.inArray(value['nom_volet'], VoletsNames) !== -1) {
                            } else {
                                html_menu += '<li class="text-uppercase pl-15 text-left custom-lu-style"><strong>' + value["nom_volet"] + '</strong></li>';
                                VoletsNames.push(value["nom_volet"]);
                            }
                            html_menu += '<li class="p-5 pl-20 text-left"><strong>' + value["valeur"] + '</strong></li>';
                        });
                    }
                    volet_menu = html_menu;
                }
            });
        }*/


        //get liste ville Json (Global)
        function getVilleByCodePostal(idCodePostal, idVille) {
            var code_postal = $('#' + idCodePostal).val();
            if (code_postal.length > 2) {
                $.ajax({
                    url: app_url + "get-villes/" + code_postal,
                    type: "GET",
                    cache: false,
                    success: function (data) {
                        if (data.success) {
                            $('#' + idVille).html(data.data);
                            $('.bootstrap-select').selectpicker('refresh');
                        }
                    }
                });
            } else {
                $('#'+idVille).html('');
                $('.bootstrap-select').selectpicker('refresh');
            }
        }


        $('#tarif_banque_code_postal').on('change paste keyup', function () {
            var code_postal = $(this).val();
            if (code_postal.length > 2) {
                $.ajax({
                    url: app_url + "get-villes/" + code_postal,
                    type: "GET",
                    cache: false,
                    success: function (data) {
                        if (data.success) {
                            $('#tarif_banque_ville_id').html(data.data)
                            $('.bootstrap-select').selectpicker('refresh');
                        }
                    }
                });
            } else {
                $('#tarif_banque_ville_id').html('');
                $('.bootstrap-select').selectpicker('refresh');
            }
        });


        //------------------------------------ Contrat modal js ------------------------------

        //pour modifier les infos de paiement
        $("#modal_contrat").on('click', '#update-paiement-infos', function () {
            //alert('test')
            $('.modal-paiement-launch').trigger("click");
        });
        //pour enregistrer la contrat
        $("#modal_contrat").on('click', '.btn-save-devis', function () {
            //hide errors messages & tarif alert
            $(".error-msg").find("strong").html('');
            $("#contrat-alert").remove();
            $.ajax({
                type: "POST",
                url: app_url + "set-contrat-infos",
                data: $("#contrat_form").serialize(),
                cache: false,
                success: function (data) {
                    if ($.isEmptyObject(data.errors)) {
                        if (data.data !== "" && data.data != null) {
                            $("#contrat_form").append('<input type="hidden" name="devis_id" value="' + data.data + '" >');
                        }
                        if (data.success) {
                            $('#contrat-modal-body').prepend("<div class=\"alert alert-info alert-styled-left rounded0\" id=\"contrat-alert\">\n" +
                                "                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span\n" +
                                "                                                class=\"sr-only\">Close</span></button>\n" +
                                "                                    <span class=\"text-semibold\">Message ! </span>\n" +
                                "                                    " + data.message + " !\n" +
                                "                       </div>");
                        }
                        swal({
                                title: "Devis Envoyé",
                                text: data.message,
                                type: "success",
                                confirmButtonText: "Ok",
                                confirmButtonColor: "#ec6c62",
                                //closeOnConfirm: false
                            },
                            function () {
                                $('#modal_contrat').modal('hide');
                            });

                    } else {
                        printErrorMsg(data.errors);
                    }
                }
            });
        });
        //pour lancer le madal de contrat

        //-------------------------------------- /Contrat modal js--------------------------------


        //------------------------------------  Compte paiement modal js ------------------------------

        //pour lancer le modal de paiement
        $('.modal-paiement-launch').on('click', function () {
            var fiche_id = $('#fiche_id').val();
            $.ajax({
                url: app_url + "get-paiement-infos/" + fiche_id,
                type: "GET",
                cache: false,
                success: function (data) {
                    $('#modal_paiement').html(data);
                    $('.bootstrap-select').selectpicker('refresh');
                    $('#modal_paiement').modal('show');
                }
            });
        });

        //code postale compte titulaire
        $('#code_postal').on('change paste keyup', function () {
            getVilleByCodePostal('code_postal', 'ville_id');
        });


        //code postale compte titulaire
        $('#modal_paiement').on('change paste keyup', '#code_postal_tt', function () {
            getVilleByCodePostal('code_postal_tt', 'ville_id_tt');
        });
        //banque code postale
        $('#modal_paiement').on('change paste keyup', '#code_postal_compte', function () {
            getVilleByCodePostal('code_postal_compte', 'ville_id_compte');
        });
        //event on banque nom
        $('#modal_paiement').on('paste keyup', '#banque_nom', function () {
            var nom_banque = $(this).val();
            if (nom_banque.length > 2) {
                $.ajax({
                    url: app_url + "get-liste-banques",
                    type: "POST",
                    data: {_token: _token, nom_banque: nom_banque},
                    cache: false,
                    success: function (data) {
                        if (data.success) {
                            $('#banque-live-search-nom').html(data.data)
                        }
                    }
                });
            }
        });
        //choisir la banque nom
        $('#modal_paiement').on('click', '.banque-name', function () {
            var banque_nom = $(this).attr('data-banque-nom');
            $('#banque_nom').val(banque_nom);
            $('#banque-live-search-nom').html('');
            $('.bootstrap-select').selectpicker('refresh');
        });
        //enregistrer les infos du compte paiement
        $('#modal_paiement').on('click', '.btn-save-paiement', function () {
            $('.error-msg').find('strong').html('');
            $('#paiement-alert').remove();
            $.ajax({
                type: "POST",
                url: app_url + "set-paiement-infos",
                data: $("#form_paiement").serialize(),
                cache: false,
                success: function (data) {
                    if ($.isEmptyObject(data.errors)) {
                        if (data.success) {
                            $('.paiement-banque-nom-section').html($('#banque_nom').val());
                            $('.paiement-compte-iban').html($('#iban_compte').val());
                            $('.paiement-compte-infos').html($('#nom_tt').val() + " " + $('#prenom_tt').val());
                            if (data.data !== "") {
                                $('#form_paiement').append('<input type="hidden" value="' + data.data['id'] + '" id="compte_id" name="compte_id">')
                            }
                            $('#paiement-modal-body').prepend("<div class=\"alert alert-success alert-styled-left rounded0\" id=\"paiement-alert\">\n" +
                                "                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span\n" +
                                "                                                class=\"sr-only\">Close</span></button>\n" +
                                "                                    <span class=\"text-semibold\">Success ! </span>\n" +
                                "                                    " + data.message + " !\n" +
                                "                       </div>")
                        } else {

                            $('#paiement-modal-body').prepend("<div class=\"alert alert-warning alert-styled-left rounded0\" id=\"paiement-alert\">\n" +
                                "                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span\n" +
                                "                                                class=\"sr-only\">Close</span></button>\n" +
                                "                                    " + data.message + " !\n" +
                                "                                    <span class=\"text-semibold\">Warning ! </span>\n" +
                                "                        </div>")
                        }
                    } else {
                        printErrorMsg(data.errors);
                    }
                }
            });
        });

        //------------------------------------- /Compte paiement modal js--------------------------


        //------------------------------------ Résiliations js----------------------------------
        //pour lancer le modal de resiliation
        $('.modal-resiliation-launch').on('click', function () {
            var fiche_id = $('#fiche_id').val();
            $.ajax({
                url: app_url + "get-resiliation-infos/" + fiche_id,
                type: "GET",
                cache: false,
                success: function (data) {
                    $('#modal_resiliation').html(data);
                    $('.bootstrap-select').selectpicker('refresh');
                    $('#modal_resiliation').modal('show');
                    $(".date-picker").datepicker({
                        format: 'dd/mm/yyyy',
                        //autoclose: true,
                        todayHighlight: true
                    });
                }
            });
        });
        //changer le resiliation
        $('#modal_resiliation').on('change', '#resiliation_id', function () {
            var resiliation_id = $(this).val();
            if (resiliation_id != '') {
                $.ajax({
                    url: app_url + "get-resiliation/" + resiliation_id,
                    type: "get",
                    cache: false,
                    success: function (data) {
                        console.log(data.data);
                        $('#organisme_resiliation').val(data.data['organisme']);
                        $('#motif_resiliation').val(data.data['motif'])
                        $('#date_echeance_resiliation').val(data.data['date_echeance']);
                        $('#numero_police_resiliation').val(data.data['numero_police']);
                        $('#adresse_resiliation').val(data.data['adresse']);
                        $('#telephone_resiliation').val(data.data['telephone']);
                        $('#code_postal_resiliation').val("");
                        if (data.data['ville_id'] != null) {
                            $('#ville_id_resiliation').html('<option value="' + data.data['ville_id'] + '">' + data.data['ville_name'] + '</option>');
                        }
                        $('.bootstrap-select').selectpicker('refresh');
                    }
                });
            } else {
                $('#organisme_resiliation').val("");
                $('#motif_resiliation').val("");
                $('#date_echeance_resiliation').val("");
                $('#numero_police_resiliation').val("");
                $('#adresse_resiliation').val("");
                $('#telephone_resiliation').val("");
                $('#code_postal_resiliation').val("");
                $('#ville_id_resiliation').html("");
                $('.bootstrap-select').selectpicker('refresh');
            }
        });
        //code postal resiliation
        $('#modal_resiliation').on('change paste keyup', '#code_postal_resiliation', function () {
            getVilleByCodePostal('code_postal_resiliation', 'ville_id_resiliation');
        });
        //enregistrer la resiliation
        $("#modal_resiliation").on('click', '.btn-save-resiliation', function () {
            //hide errors messages & tarif alert
            $(".error-msg").find("strong").html('');
            $("#resiliation-alert").remove();
            $.ajax({
                type: "POST",
                url: app_url + "set-resiliation-infos",
                data: $("#form_resiliation").serialize(),
                cache: false,
                success: function (data) {

                    if ($.isEmptyObject(data.errors)) {
                        if (data.data !== "" && data.data != null) {
                            $('#resiliation_id').append('<option value="' + data.data['id'] + '">' + data.data['organisme'] + '</option>');
                            $('#resiliation_id').val(data.data['id']);
                            $('.bootstrap-select').selectpicker('refresh');
                        }
                        if (data.success) {
                            $('#resiliation-modal-body').prepend("<div class=\"alert alert-info alert-styled-left rounded0\" id=\"resiliation-alert\">\n" +
                                "                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span\n" +
                                "                                                class=\"sr-only\">Close</span></button>\n" +
                                "                                    <span class=\"text-semibold\">Message ! </span>\n" +
                                "                                    " + data.message + " !\n" +
                                "                       </div>");
                        }
                    } else {
                        printErrorMsg(data.errors);
                    }
                }
            });
        });
        //------------------------------------ /Résiliations js---------------------------------


        //------------------------------------------ Mail --------------------------------------
        //mail js
        $('.modal-mail-launch').on('click', function () {
            var fiche_id = $('#fiche_id').val();
            $.ajax({
                url: app_url + "get-mail-form/" + fiche_id,
                type: "GET",
                cache: false,
                success: function (data) {
                    $('#modal_mail').html(data);
                    //$(".summernote").summernote("code", "<b>your text</b>");
                    $('.summernote').summernote('reset');
                    $('.bootstrap-select').selectpicker('refresh');
                    $('#modal_mail').modal('show');
                }
            });
        });
        //end of mail js


        //get template infos
        $('#modal_mail').on('change', '#template', function () {
            templateVal = $(this).val();
            if (templateVal != '0') {
                $.ajax({
                    url: app_url + "get-template-infos/" + templateVal,
                    type: "GET",
                    cache: false,
                    success: function (data) {
                        $(".summernote").summernote("code", data.data['template']);
                    }
                });
            } else {
                $('.summernote').summernote('reset');
            }
        });
        //end of mail js

        //sms modal launch
        $('.modal-sms-launch').on('click', function () {
            $('#modal_sms').modal('show');
        });

        //--------------------------------------------------------------------------------------

        //check fiche etat
        $('#etat_id').on('change', function () {
            ficheEtat = $(this).val();
            var fiche_id = $('#fiche_id').val();
            $.ajax({
                url: app_url + "check-fiche-etat/" + ficheEtat,
                type: "GET",
                cache: false,
                success: function (data) {
                    if (data.success) {
                        if (data.data['contrat']) {
                            getContratInfos(fiche_id, null, null, true);
                        }
                    }
                }
            });
        });

        //--------------------check fiche etat
        //get gammes
        $('#modal_contrat').on('change', '#compagnie_id', function () {
            $('#gamme_id').html('<option selected="" value="">-- Choisir la gamme --</option>');
            $('#formule_id').html('<option selected="" value="">-- Choisir la formule --</option>');
            var compagnie_id = $(this).val();
            if (compagnie_id != "") {
                $.ajax({
                    url: app_url + "get-gammes-by-compagnie/" + compagnie_id,
                    type: "GET",
                    cache: false,
                    success: function (data) {
                        if (data.success) {
                            $.each(data.data, function (index, value) {
                                $('#gamme_id').append('<option value="' + value['id'] + '">' + value['nom'] + '</option>');
                            });
                        }
                    }
                });
            }

        });
        //get formules
        $('#modal_contrat').on('change', '#gamme_id', function () {
            $('#formule_id').html('<option selected="" value="">-- Choisir la formule --</option>');
            var gamme_id = $(this).val();
            if (gamme_id != "") {
                $.ajax({
                    url: app_url + "get-formules-by-gamme/" + gamme_id,
                    type: "GET",
                    cache: false,
                    success: function (data) {
                        if (data.success) {
                            $.each(data.data, function (index, value) {
                                $('#formule_id').append('<option value="' + value['id'] + '">' + value['nom'] + '</option>');
                            });
                        }
                    }
                });
            }
        });


        //check devis(update or add) and go to steper
        $('#modal_contrat').on('change', '#gamme_id', function () {

        });


    })
</script>




