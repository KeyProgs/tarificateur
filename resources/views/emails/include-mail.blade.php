<form id="mailForm" method="post" enctype="multipart/form-data">
    <div class="col-md-12 modal-contenu" id="paiement-modal-body">
        <!-- New mail -->
        @csrf
        <div class="panel panel-white">
            <!-- Mail toolbar -->
            <div class="panel-toolbar panel-toolbar-inbox">
                <div class="navbar navbar-default">
                    <ul class="nav navbar-nav visible-xs-block no-border">
                        <li>
                            <a class="text-center collapsed" data-toggle="collapse"
                               data-target="#inbox-toolbar-toggle-single">
                                <i class="icon-circle-down2"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="navbar-collapse collapse" id="inbox-toolbar-toggle-single">
                        <div class="btn-group navbar-btn pull-right">
                            <button type="button"
                                    class="btn-send-mail btn bg-blue btn_send_message">
                                <i class="icon-checkmark3 position-left"></i> Envoyer
                            </button>
                            &nbsp;&nbsp;
                            <button type="button" class="btn-save-mail btn btn-default"><i
                                        class="icon-plus2"></i>
                                <span class="hidden-xs position-right"> Enregistrer</span>
                            </button>
                        </div>


                        <div class="pull-left" style="width: 70%;">

                            <div class="btn-group navbar-btn" style="width: 50%;">
                                <select name="template" id="template"
                                        class="bootstrap-select form-control" style="width: 100%">
                                    <option selected value="0">
                                        -------------- Choisir une template -------------
                                    </option>
                                    @foreach($templates as $template)
                                        <option value="{{$template->id}}">{{$template->nom}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /mail toolbar -->


            <!-- Mail details -->
            <div class="table-responsive mail-details-write">
                <table class="table">
                    <tbody>
                    <tr>
                        <td style="width: 150px">A :</td>
                        <td class="no-padding"><input required type="email" name="recepteur"
                                                      class="form-control"
                                                      placeholder="Recepteur de message"
                                                      value="{{@$fiche->personne->email}}"></td>
                        <td style="width: 250px" class="text-right">

                        </td>
                    </tr>
                    <tr>
                        <td>Objet :</td>
                        <td class="no-padding"><input required type="text" name="objet"
                                                      class="form-control"
                                                      placeholder="Objet de message"></td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /mail details -->


            <!-- Mail container -->
            <div class="mail-container-write">
                <textarea name="message" required minlength=20 class="summernote"></textarea>
            </div>
            <!-- /mail container -->

            <!-- Attachments -->

            <div class="panel panel-flat">
                <!-- Mail Attachments -->
                <div class="panel-body">
                    <b>
                        <i class="icon-attachment position-left"></i>
                        Joindre des fichiers
                    </b>
                    <br><br>
                    <input type="file" name="pieces_jointes[]" class="file-input"
                           multiple="multiple">

                    @if ($errors->has('pieces_jointes.*'))

                        <span class="text-danger error-msg">
                                                <strong class="text-danger"> - {{ $errors->first('pieces_jointes.*') }}</strong>
                                            </span>
                    @endif

                </div>
                <!-- /mail attachments -->
            </div>
            <!-- /attachments -->

        </div>
        <!-- /new mail -->
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        $('.summernote').summernote('reset');
        $('.bootstrap-select').selectpicker('refresh');

        $.ajax({
            url: app_url + "get-template-infos/" + 13,
            type: "GET",
            cache: false,
            success: function (data) {
                $(".summernote").summernote("code", data.data['template']);
            }
        });
        $(".btn-send-mail").on('click', function () {
            $('#mailForm').attr('action', '{{url('/mail/nouveau')}}');
            $('#mailForm').submit();
        });
        $(".btn-save-mail").on('click', function () {
            $('#mailForm').attr('action', '{{url('/mail/enregister-mail')}}');
            $('#mailForm').submit();
        });


        //get template infos
        $('#template').on('change', function () {
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
    });
</script>