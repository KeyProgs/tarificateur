<div class="modal-dialog modal-sm mt-15" style="width:70%">
    <div class="modal-content rounded0">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h5 class="modal-title">Nouveau message</h5>
        </div>
        <div class="modal-body">
            <div class="col-md-12 pl0 pr0">
                <div class="row">
                    <form id="form_paiement">
                        <div class="col-md-12 modal-contenu" id="paiement-modal-body">
                            <!-- New mail -->
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
                                                <button type="submit" class="btn bg-blue btn_send_message">
                                                    <i class="icon-checkmark3 position-left"></i> Envoyer
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
                                            <td class="no-padding"><input type="text" name="message_recepteur"
                                                                          class="form-control"
                                                                          placeholder="Recepteur de message"
                                                                          value="{{$fiche->personne->email}}"></td>
                                            <td style="width: 250px" class="text-right">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Objet :</td>
                                            <td class="no-padding"><input type="text" name="message_objet"
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
                                    <textarea name="message_content" class="summernote">

                                    </textarea>
                                </div>
                                <!-- /mail container -->


                                <!-- Attachments -->
                                <div class="mail-attachments-container">
                                    <h6 class="mail-attachments-heading">2 Attachments</h6>

                                    <ul class="mail-attachments">
                                        <li>
											<span class="mail-attachments-preview">
												<i class="icon-file-pdf icon-2x"></i>
											</span>

                                            <div class="mail-attachments-content">
                                                <span class="text-semibold">new_december_offers.pdf</span>

                                                <ul class="list-inline list-inline-condensed no-margin">
                                                    <li class="text-muted">174 KB</li>
                                                    <li><a href="#">View</a></li>
                                                    <li><a href="#">Remove</a></li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
											<span class="mail-attachments-preview">
												<i class="icon-file-pdf icon-2x"></i>
											</span>

                                            <div class="mail-attachments-content">
                                                <span class="text-semibold">assignment_letter.pdf</span>

                                                <ul class="list-inline list-inline-condensed no-margin">
                                                    <li class="text-muted">736 KB</li>
                                                    <li><a href="#">View</a></li>
                                                    <li><a href="#">Remove</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /attachments -->

                            </div>
                            <!-- /new mail -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="hidden rounded0 btn btn-link" data-dismiss="modal">Fermer</button>
            <button type="button" class="hidden btn-save-paiement rounded0 btn btn-primary">Enregistrer</button>
        </div>
    </div>
</div>

