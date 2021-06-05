<div id="modal_upload" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div id="modal_upload_dialog" class="modal-dialog modal-sm mt-15" style="width: 80%">
        <div class="modal-content rounded0">
            <div class="modal-body p-10">
                <div class="col-md-12">
                    <div class="row">
                        @if(Session::has('error_modif'))
                            <form id="form_upload"
                                  action="{{url('/'.$type.'/'.$type_id.'/piece-jointe/'.Session::get('piece')->id)}}"
                                  method="post" enctype="multipart/form-data">
                                @else
                                    <form id="form_upload"
                                          action="{{url('/'.$type.'/'.$type_id.'/nouvelle-piece-jointe/')}}"
                                          method="post" enctype="multipart/form-data">
                                        @endif
                                        @csrf
                                        <input type="hidden" name="type_id" value="{{$type_id}}">
                                        <input type="hidden" name="type" value="{{$type}}">
                                        <div class="col-md-12 modal-contenu mt-20">
                                            <div class="content-group border-top-lg border-top-primary">
                                                <div class="breadcrumb-line"
                                                     style="border-bottom: 1px solid lightgray;">
                                                    <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                                                    <ul class="breadcrumb">
                                                        <li class="text-bold">
                                                            <i class="icon-file-upload position-left"></i>
                                                            Upload un fichier
                                                        </li>
                                                    </ul>

                                                    <ul class="breadcrumb-elements">
                                                        <li class="mt-10">
                                                            <button type="button" class="text-bold close"
                                                                    data-dismiss="modal">
                                                                ×
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="panel registration-form">
                                                    <div class="panel-body">
                                                        <div class="text-center">
                                                            <div class="icon-object border-success text-success">
                                                                <i class="icon-file-text3"></i>
                                                            </div>
                                                            <h5 class="content-group-lg">Fichier informations &nbsp;

                                                                <b id="file-upload-title">
                                                                    @if(Session::has('error_modif'))
                                                                        @if(Session::get('piece')->description != null)
                                                                            {{Session::get('piece')->description}}
                                                                        @else
                                                                            {{Session::get('piece')->url}}
                                                                        @endif
                                                                    @endif
                                                                </b>
                                                                <small class="display-block hidden">All fields are
                                                                    required
                                                                </small>
                                                            </h5>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group has-feedback">
                                                                    Fichier
                                                                    <input type="file" name="fichier"
                                                                           class="file-styled">
                                                                    @if ($errors->has('fichier'))
                                                                        <span class="text-danger error-msg">
                                                         <strong class="text-danger">{{ $errors->first('fichier') }}</strong>
                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group has-feedback">
                                            <textarea type="text" class="form-control" id="fichier_description"
                                                      name="fichier_description" rows="5"
                                                      placeholder="Description">{{old('description')}}</textarea>
                                                                    @if($errors->has('fichier_description'))
                                                                        <span class="text-danger error-msg">
                                                         <strong class="text-danger">{{ $errors->first('fichier_description') }}</strong>
                                                    </span>
                                                                    @endif
                                                                    <div class="form-control-feedback">
                                                                        <i class="icon-file-text3 text-muted"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="text-right mt-20">
                                                            <button type="button" class="rounded0 btn btn-link"
                                                                    data-dismiss="modal">Fermer
                                                            </button>
                                                            <button
                                                                    @if($type=="fiche")
                                                                    onclick="enregistrerFiche()"
                                                                    @endif
                                                                    type="submit"
                                                                    class="rounded0 btn bg-teal-400 btn-labeled btn-labeled-right ml-10">
                                                                <b><i class="icon-plus3"></i></b> Enregistrer
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

@if ($errors->has('fichier') || $errors->has('type_id'))
    <script>
        $('#modal_upload').modal('show');
    </script>
@endif