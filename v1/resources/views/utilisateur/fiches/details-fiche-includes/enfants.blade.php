<!-- Section Enfants-->
<div class="row">
    <input type="hidden" value="{{$fiche->personne->details->id}}" name="details_id">
    <div class="col-md-12 bg-grey-700 p0">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-group border-top-lg border-top-primary">
                        <div class="page-header page-header-default">
                            <div class="breadcrumb-line"><a
                                        class="breadcrumb-elements-toggle">
                                    <i class="icon-menu-open"></i></a>
                                <ul class="breadcrumb">
                                    <li class="text-bold"><i
                                                class="icon-users4 position-left"></i>
                                        Enfants
                                    </li>
                                </ul>

                                <ul class="breadcrumb-elements">
                                    <li>
                                        <a id="add-enfant-section"
                                           class="legitRipple"><i
                                                    class="icon-user-plus position-left"></i>
                                            Ajouter
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="page-header-content">
                                <div class="row pt-10 pb-20">
                                    <div class="" style="padding: 0;">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr class="bg-grey-300">
                                                <th class="width-130">Nom</th>
                                                <th class="width-130">Prénom</th>
                                                <th class="width-120">Sexe</th>
                                                <th>Date naissance</th>
                                                <th class="width-120">Ayant Droit</th>
                                                <th>N° Sécu social</th>
                                                <th class="pl-5 pr-5">Actions</th>
                                            </tr>
                                            </thead>

                                            <tbody id="table_enfants_body">
                                            @php
                                                {{
                                                $count_enfants = 0 ;
                                                $enfants = $fiche->personne->enfants();
                                                    /*if(!empty($conjoint)){
                                                      $enfants_conjoint = $conjoint->enfants();
                                                    }*/
                                                }}
                                            @endphp
                                            @include('includes.fiche-includes.tr-enfant', ['enfants' => $enfants])
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            {{global $count_enfants;}}
        @endphp
        <input type="hidden" name="count_enfants" id="count_enfants"
               value="{{$count_enfants}}">
    </div>
</div>
<!-- /section Enfants-->