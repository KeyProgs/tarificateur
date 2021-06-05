<!-- Section adresse postale & code postal -->
<div class="row">
    <!-- Section adresse postale -->
    <div class="col-md-8">
        <div class="content-group border-top-lg border-top-blue">
            <div class="page-header page-header-default">
                <div class="breadcrumb-line ">

                    <ul class="breadcrumb pt-10 pb-14">
                        <li class="text-bold"><i
                                    class="icon-location3 position-left"></i>
                            Adresse postale
                        </li>
                    </ul>

                    <ul class="breadcrumb-elements hidden">
                        <li>
                            <button type="button"
                                    class="btn btn-default btn-icon btn-rounded legitRipple mt-3">
                                <i class="icon-plus-circle2"></i></button>
                        </li>
                    </ul>
                </div>

                <div class="page-header-content pb-20 pt-6">
                    <div class="row pt-10">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-custom-grey text-bold">Adresse
                                    complète </label>
                                <input type="text" name="adresse" id="adresse"
                                       class="mt-m15 form-control"
                                       value="{{$fiche->personne->details->adresse}}">
                                <span class="text-danger error-msg" id="error_adresse">
                                                     <strong class="text-danger"></strong>
                                               </span>
                            </div>
                        </div>
                    </div>
                    <div class="row col-md-6">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-custom-grey text-bold">
                                    N° Apt / Etage
                                </label>
                                <input type="text" name="numero_appartement_etage"
                                       id="numero_appartement_etage"
                                       class="mt-m15 form-control"
                                       value="{{$fiche->personne->details->numero_appartement_etage}}">
                                <span class="text-danger error-msg"
                                      id="error_numero_appartement_etage">
                                                     <strong class="text-danger"></strong>
                                               </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-custom-grey text-bold">
                                    Rés, Bat, Imm
                                </label>
                                <input type="text" name="residence_immeuble_batiment"
                                       id="residence_immeuble_batiment"
                                       class="mt-m15 form-control"
                                       value="{{$fiche->personne->details->residence_immeuble_batiment}}">
                                <span class="text-danger error-msg"
                                      id="error_residence_immeuble_batiment">
                                                     <strong class="text-danger"></strong>
                                               </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-custom-grey text-bold">N° </label>
                                <input type="text" name="numero" id="numero"
                                       class="mt-m15 form-control"
                                       value="{{$fiche->personne->details->numero}}">
                                <span class="text-danger error-msg" id="error_numero">
                                                     <strong class="text-danger"></strong>
                                               </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-custom-grey text-bold">AV. / Rue /
                                    Lieu
                                    dit </label>
                                <input type="text" name="avenue_rue" id="avenue_rue"
                                       class="mt-m15 form-control"
                                       value="{{$fiche->personne->details->avenue_rue}}">
                                <span class="text-danger error-msg"
                                      id="error_avenue_rue">
                                                     <strong class="text-danger"></strong>
                                               </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-custom-grey text-bold">Code
                                    postal </label>
                                <input type="text" name="code_postal" id="code_postal"
                                       class="mt-m15 form-control"
                                       value="{{$fiche->personne->details->code_postal}}">
                                <span class="text-danger error-msg"
                                      id="error_code_postal">
                                                     <strong class="text-danger"></strong>
                                               </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-custom-grey text-bold">Ville</label>
                            <!--<input type="text" name="ville" id="ville"
                                       class="mt-m15 form-control"
                                       value="{{$fiche->personne->details->ville}}">-->

                                <select name="ville_id" id="ville_id"
                                        class="mt-m15 bootstrap-select form-control form-control-sm"
                                        style="    padding: 8px;">
                                    @if($fiche->personne->details->laville != null))
                                    <option value="{{$fiche->personne->details->laville->id}}">{{$fiche->personne->details->laville->name}}
                                        ({{$fiche->personne->details->laville->zip_code}})
                                    </option>
                                    @else
                                        @if($fiche->personne->details->code_postal != null)
                                            @php
                                                $ville = new \App\Details_personne();
                                                echo $ville->getVilleByCodePostal($fiche->personne->details->code_postal);
                                            @endphp
                                        @endif
                                    @endif
                                </select>
                                <span class="text-danger error-msg" id="error_ville_id">
                                                     <strong class="text-danger"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">


                    </div>

                    <div class="row">


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Section adresse postale-->

    <!--Section contact-->
    <div class="col-md-4">
        <div class="content-group border-top-lg border-top-blue">
            <div class="page-header page-header-default">
                <div class="breadcrumb-line ">

                    <ul class="breadcrumb pt-10 pb-14">
                        <li class="text-bold"><i class="icon-phone position-left"></i>
                            Contact
                        </li>
                    </ul>

                    <ul class="breadcrumb-elements hidden">
                        <li>
                            <button type="button" id=""
                                    class="btn btn-default btn-icon btn-rounded legitRipple mt-3">
                                <i class="icon-plus-circle2"></i></button>
                        </li>
                    </ul>
                </div>

                <div class="page-header-content pb-20 pt-20">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-custom-grey text-bold">E-mail </label>
                                <input type="email" name="email" id="email"
                                       class="mt-m15 form-control"
                                       value="{{$fiche->personne->details->email}}">
                                <span class="text-danger error-msg" id="error_email">
                                                     <strong class="text-danger"></strong>
                                               </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-custom-grey text-bold">
                                    Téléphone 1 </label>
                                <input  type="text"
                                       name="telephone_1" id="telephone_1"
                                       class="mt-m15 form-control"
                                       value="{{$fiche->personne->details->telephone_1}}"/>
                                <span class="text-danger error-msg"
                                      id="error_telephone_1">
                                      <strong class="text-danger"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-custom-grey text-bold">Téléphone
                                    2 </label>
                                <input  type="text"
                                       name="telephone_2" id="telephone_2"
                                       class="mt-m15 form-control"
                                       value="{{$fiche->personne->details->telephone_2}}">
                                <span class="text-danger error-msg"
                                      id="error_telephone_2">
                                                     <strong class="text-danger"></strong>
                                               </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-custom-grey text-bold">Téléphone
                                    3 </label>
                                <input type="text"
                                       name="telephone_3" id="telephone_3"
                                       class="mt-m15 form-control"
                                       value="{{$fiche->personne->details->telephone_3}}">
                                <span class="text-danger error-msg"
                                      id="error_telephone_3">
                                                     <strong class="text-danger"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/Section contact-->
</div>
<!-- /Section adresse postale & code postal -->
