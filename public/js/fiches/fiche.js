var boolrec = false;

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

//pour modifier la fiche
function trueOrFals(bool) {
    return bool;
}

function enregistrerFiche() {
    //hide errors messages & fiche alert
    $(".error-msg").find("strong").html('');
    $("#fiche-alert").remove();

    //var boolrec = false;
    $.ajax({
        type: "POST",
        url: app_url + "modification-fiche-ajax",
        data: $("#fiche_forme").serialize(),
        cache: false,
        success: function (data) {
            if ($.isEmptyObject(data.errors)) {
                if (data.success) {
                    $('#fiche-div').prepend("<div class=\"alert alert-success alert-styled-left\" id=\"fiche-alert\">\n" +
                        "                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span\n" +
                        "                                                class=\"sr-only\">Close</span></button>\n" +
                        "                                    <span class=\"text-semibold\">Success ! </span>\n" +
                        "                                    " + data.message + " !\n" +
                        "                    </div>");
                    $("html, body").animate({scrollTop: 0}, "slow");
                    //alert('2 true');
                    boolrec = true;


                    //$('#modal_default').modal('show');
                } else {
                    $('#fiche-div').prepend("<div class=\"alert alert-warning alert-styled-left\" id=\"fiche-alert\">\n" +
                        "                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span\n" +
                        "                                                class=\"sr-only\">Close</span></button>\n" +
                        "                                    <span class=\"text-semibold\">Warning ! </span>\n" +
                        "                                    " + data.message + " !\n" +
                        "                    </div>");
                    $("html, body").animate({scrollTop: 0}, "slow");
                    //alert('Erreur fiche.js 54');
                    boolrec = false;

                }
            } else {
                boolrec = false;
                printErrorMsg(data.errors);
            }

        },
        error: function () {
            $('#fiche-div').prepend("<div class=\"alert alert-warning alert-styled-left\" id=\"fiche-alert\">\n" +
                "                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span\n" +
                "                                                class=\"sr-only\">Close</span></button>\n" +
                "                                    <span class=\"text-semibold\">Warning!</span>\n" +
                "                                    Une erreur est survenue dans le script de cette page !\n" +
                "                   </div>");
            $("html, body").animate({scrollTop: 0}, "slow");
            boolrec = false;
        }

    });

}


$(document).ready(function () {

    // $('.sidebar-control').trigger('click');
    //var count_enfants = parseInt($('#count_enfants').val());

    var count_enfants;
    if ($('#count_enfants').val() != '') {
        count_enfants = parseInt($('#count_enfants').val());
    } else {
        count_enfants = 0;
    }

    //show section conjoint
    $("#add-conjoint-section").on('click', function () {
        //check section conjoint display
        if ($('#conjoint-section').css('display') == 'none') {
            $('#conjoint-section').css('display', 'block')
            $("#add-conjoint-section").html('<i class="icon-minus-circle2"></i>&nbsp;Supprimer');
            $('#has_conjoint').val('1');
            $(".ayant-droit-en").append('<option value=Conjoint>Conjoint</option>');
        } else {
            $('#conjoint-section').css('display', 'none')
            $("#add-conjoint-section").html('<i class="icon-plus-circle2"></i>&nbsp;Ajouter');
            $('#has_conjoint').val('');
            $(".ayant-droit-en option[value='Conjoint']").remove();
        }
    });
    //ajouter enfant ligne html js
    $("#add-enfant-section").on('click', function () {
        count_enfants = count_enfants + 1;
        var section_enfant_html = '  <tr id="tr_enfant_' + count_enfants + '">\n' +
            '                                                                <td>\n' +
            '                                                                    <input type="text" name="nom_en_' + count_enfants + '" id="nom_en_' + count_enfants + '"\n' +
            '                                                                           class="mt-m15 form-control">\n' +
            '                                                                 <span class="text-danger error-msg" id="error_nom_en_' + count_enfants + '">\n' +
            '                                                                       <strong class="text-danger"></strong>\n' +
            '                                                                 <span>\n' +
            '                                                                </td>\n' +
            '                                                                <td>\n' +
            '                                                                    <input type="text" name="prenom_en_' + count_enfants + '" id="prenom_en_' + count_enfants + '"\n' +
            '                                                                           class="mt-m15 form-control">\n' +
            '                                                                 <span class="text-danger error-msg" id="error_prenom_en_' + count_enfants + '">\n' +
            '                                                                       <strong class="text-danger"></strong>\n' +
            '                                                                 <span>\n' +
            '                                                                </td>\n' +
            '                                                                <td>\n' +
            '                                                                    <select name="sexe_en_' + count_enfants + '" id="sexe_en_' + count_enfants + '" class="mt-m15 form-control form-control-sm ">\n' +
            '                                                                        <option value=""></option>\n' +
            '                                                                        <option value="M">Masculin</option>\n' +
            '                                                                        <option value="F">Féminin</option>\n' +
            '                                                                    </select>\n' +
            '                                                                 <span class="text-danger error-msg" id="error_sexe_en_' + count_enfants + '">\n' +
            '                                                                       <strong class="text-danger"></strong>\n' +
            '                                                                 <span>\n' +
            '                                                                </td>\n' +
            '                                                                <td>\n' +
            '                                                                    <input type="text" name="date_naissance_en_' + count_enfants + '" id="date_naissance_en_' + count_enfants + '"\n' +
            '                                                                           class="date-picker mt-m15 form-control">\n' +
            '                                                                 <span class="text-danger error-msg" id="error_date_naissance_en_' + count_enfants + '">\n' +
            '                                                                       <strong class="text-danger"></strong>\n' +
            '                                                                 <span>\n' +
            '                                                                </td>\n' +
            '                                                                <td>\n' +
            '                                                                    <select  name="ayant_droit_en_' + count_enfants + '" id="ayant_droit_en_' + count_enfants + '" class="mt-m15 form-control form-control-sm ayant-droit-en">\n' +
            '                                                                        <option value=""></option>\n' +
            '                                                                        <option value="Prospect">Prospect</option>\n' +
            '                                                                        <option value="Conjoint">Conjoint</option>\n' +
            '                                                                    </select>\n' +
            '                                                                 <span class="text-danger error-msg" id="error_ayant_droit_en_' + count_enfants + '">\n' +
            '                                                                       <strong class="text-danger"></strong>\n' +
            '                                                                 <span>\n' +
            '                                                                </td>\n' +
            '                                                                <td>\n' +
            '                                                                    <input type="text" data-mask="9-99-99-99-999-999-99" name="numero_securite_social_en_' + count_enfants + '" id="numero_securite_social_en_' + count_enfants + '" class="mt-m15 form-control">\n' +
            '                                                                 <span class="text-danger error-msg" id="error_numero_securite_social_en_' + count_enfants + '">\n' +
            '                                                                       <strong class="text-danger"></strong>\n' +
            '                                                                 <span>\n' +
            '                                                                </td>\n' +
            '                                                                <td class="p0" align="center">\n' +
            '                                                                    <a href="javascript:void(0)" title="Supprimer" id="' + count_enfants + '" data-enfant-id="" class="remove_enfant btn btn-link"><i class="icon-user-minus"></i></a>\n' +
            '                                                                 </td>\n' +
            '                                                            </tr>';
        $('#table_enfants_body').append(section_enfant_html);
        $('#count_enfants').val(count_enfants);
        $(".date-picker").datepicker({
            format: 'dd/mm/yyyy',
            //autoclose: true,
            todayHighlight: true
        });

    });
    //suppression ligne enfant
    $('#table_enfants_body').on('click', '.remove_enfant', function () {
        var trId = this.id;
        var enfantId = $(this).attr("data-enfant-id");
        $('#tr_enfant_' + trId).remove();
        count_enfants = count_enfants - 1;
        $('#count_enfants').val(count_enfants);
        /*swal({
                title: "Etes vous sur ?",
                text: "Êtes-vous sûr de vouloir supprimer ce élement ? ",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Non, annulez!",
                closeOnCancel: true,
                confirmButtonText: "Oui",
                confirmButtonColor: "#ec6c62",
                closeOnConfirm: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    if (enfantId !== "") {
                        $.ajax({
                            url: app_url + "suppression-enfant/",
                            type: "POST",
                            data: {'_token': _token, 'id': enfantId},
                            cache: false,
                            success: function (data) {
                                if ($.isEmptyObject(data.error)) {
                                    $('#tr_enfant_' + trId).remove();
                                    count_enfants = count_enfants - 1;
                                    $('#count_enfants').val(count_enfants);
                                    swal("Succès", "Opération terminé avec succès!", "success");
                                } else {
                                    alert(data.error);
                                }
                            }
                        });
                    } else {
                        $('#tr_enfant_' + trId).remove();
                        count_enfants = count_enfants - 1;
                        $('#count_enfants').val(count_enfants);
                        swal("Succès", "Opération terminé avec succès!", "success");
                    }
                }
            });*/


    });

    //print errors messages


    //l'ajout d'une fiche via (ajax)
    $('.add_fiche').click(function () {
        //hide errors messages & fiche alert
        $(".error-msg").find("strong").html('');
        $("#fiche-alert").remove();

        $.ajax({
            type: "POST",
            url: app_url + "ajout-fiche-ajax",
            data: $("#fiche_forme").serialize(),
            cache: false,
            success: function (data) {
                if ($.isEmptyObject(data.errors)) {
                    if (data.success) {
                        document.location.href = app_url + 'fiche-details/' + data.data;
                    } else {
                        $('#fiche-div').prepend("<div class=\"alert alert-warning alert-styled-left\" id=\"fiche-alert\">\n" +
                            "                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span\n" +
                            "                                                class=\"sr-only\">Close</span></button>\n" +
                            "                                    <span class=\"text-semibold\">Warning ! </span>\n" +
                            "                                    " + data.message + " !\n" +
                            "                   </div>")
                    }
                } else {
                    printErrorMsg(data.errors);
                }
            }
        });
    })


    //fiche modification

    //appler la fonction de modofocation
    $('.update_fiche').on('click', function () {
        enregistrerFiche();
    });


    //on click tr get fiche historique
    $('#fiches-div').on('click', '.data-tr', function () {
        //$('.data-tr').on('click', function () {
        var fiche_id = $(this).attr('id');
        //var fiche_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: app_url + "historique-fiche-ajax",
            data: {'_token': _token, 'id': fiche_id},
            cache: false,
            success: function (data) {
                if (data.success) {
                    $('#fiche_historique').html(data.data);
                    $("#fiches-div").attr("class", "col-lg-9");
                    $('#fiche_historique').show();
                } else {
                    $('#fiche_historique').html(data.message);
                }
            }
        });
    });


    //on hide fiche historique div
    $('#fiche_historique').on('click', '.close-fiche-historique', function () {
        $('#fiche_historique').hide();
        $("#fiches-div").attr("class", "col-lg-12");
    });


    $('#etat_id').on('change', function () {
        if (this.value == 21) {
            $('#date_rappel_div').show();
        } else {
            $('#date_rappel').val('');
            $('#date_rappel_div').hide();
        }
    });


    //open fiche in new tab
    var popup;
    $('#fiches-div').on('click', '.open-fiche-new-tab', function (e) {
        e.preventDefault();
        var url = $(this).attr("data-href");
        popup = window.open(url);
    });

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
            $('#' + idVille).html('');
            $('.bootstrap-select').selectpicker('refresh');
        }
    }

    $('#code_postal').on('change paste keyup', function () {
        getVilleByCodePostal('code_postal', 'ville_id');
    });

    /*$('.close-fiche-details').click(function () {
        if (popup) popup.close();
    });*/

    $('.close-fiche-details').click(function () {
        //window.top.close();
        window.close();
    });
    //end of -> open fiche in new tab


});