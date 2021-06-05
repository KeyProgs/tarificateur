//app_url d'application
var app_url = $('meta[name=APP_URL]').attr("content") + "/";
var _token = $('meta[name=csrf-token]').attr("content");
//var webSiteUrl ='http://196.92.5.31:229/acs_website_2/';
var webSiteUrl ='http://acsassurance.com/';
$(document).ready(function () {
    $(".date-picker").datepicker({
        format: 'dd/mm/yyyy',
        //autoclose: true,
        todayHighlight: true
    });
    $(".date-picker-empty").datepicker({
        format: 'dd/mm/yyyy',
        "setDate": '',
        //autoclose: true,
        todayHighlight: true
    });

    $(".date-picker-no-day").datepicker({
        format: "mm/yyyy",
        startView: "months",
        minViewMode: "months"
    });

    //confirm suppression
    $('.confirm-delete').on('click', function () {
        var url = $(this).attr("data-href");
        swal({
                title: "Etes vous sur ?",
                text: "Êtes-vous sûr de vouloir supprimer ce élement ? ",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Non, annulez!",
                closeOnCancel: true,
                confirmButtonText: "Oui",
                confirmButtonColor: "#ec6c62",
                //showLoaderOnConfirm: true,
                closeOnConfirm: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    $(location).attr("href", url);
                }
            });
    });

    //lancer le modal de upload
    $('.launch-modal-upload').on('click', function () {
        $('#fichier_description').val("");
        $('#file-upload-title').html("");
        $('#modal_upload').modal('show');
    });

    $('.get-file-infos').on('click', function () {
        type = $(this).attr('data-type');
        type_id = $(this).attr('data-type-id');
        id = $(this).attr('data-id');

        $('#form_upload').attr('action', '/' + type + '/' + type_id + '/piece-jointe/' + id);
        $('#modal_upload').modal('show');

        ajaxUrl = $(this).attr('data-href');
        $.ajax({
            url: ajaxUrl,
            type: "GET",
            cache: false,
            success: function (data) {
                if (data.success) {
                    $('#fichier_description').val(data.data['description']);
                    if (data.data['description'] != null) {
                        $('#file-upload-title').html(data.data['description'])
                    } else {
                        $('#file-upload-title').html(data.data['url'])
                    }
                }
            }
        });
    });

    //get


    window.setInterval(function () {
        getNotifications();
    }, 7000);

    function getNotifications() {
        $('#user-notifs').html('');
        $('#user-notifs-count').html('');
        var dataHref = null;
        $.ajax({
            type: "GET",
            url: app_url + 'user-notifications',
            //data: $("#fiche_forme").serialize(),
            cache: false,
            success: function (data) {
                if (data.success) {
                    if (data.data.length > 0) {
                        $('#user-notifs-count').html(data.data.length);
                    }
                    $.each(data.data, function (index, value) {
                        if (value['devis_id'] != null) {
                            dataHref = '/devis/' + value['devis_id'];
                        } else {
                            dataHref = '/fiche-details/' + value['fiche_id'];
                        }
                        $('#user-notifs').append(`<li data-href="` + dataHref + `" id="` + value['id'] + `" class="media" style="cursor: pointer ;">
                            <div class="media-left">
                                <a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs">
                                    <i class="icon-user"></i>
                                </a>
                            </div>
        
                            <div class="media-body">
                                <a href="#">` + value['agent']['nom'] + " " + value['agent']['prenom'] + `</a><br><a href="#" class="historique-fiche-link">` + value['description'] + `
                                <div class="media-annotation">` + value['created_at'] + `</div>
                            </div>
                         </li>`);
                    });
                }
            }
        });
    }


    $('#user-notifs').on('click', '.media', function () {
        id = $(this).attr('id');
        href = $(this).attr('data-href');
        $.ajax({
            type: "POST",
            url: app_url + 'check-user-notification/',
            data: {'_token': _token, 'id': id},
            cache: false,
            success: function (data) {
                if (data.success) {
                    //window.location.href = '/fiche-details/' + data.data;
                    window.location.href = href
                }
            }
        });
    });


});







