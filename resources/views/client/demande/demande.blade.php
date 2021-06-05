@extends('client.layouts.client')

@section('content')
    <script src="{{asset('js/fiches/fiche.js')}}"></script>
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
        @include('includes.client.client-sidebar')
        <!-- Main content -->
            <div class="content-wrapper">
                <!-- Page header -->
            @include('includes.client-page-header',['page'=>'Ma demande'])
            <!-- /page header -->
                <!-- Content area -->
                <form id="fiche_forme">
                    <div class="content p0">
                        <div class="col-md-12">
                            @if(Session::has('message'))
                                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-styled-left alert-arrow-left alert-bordered">
                                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                                class="sr-only">Close</span></button>
                                    <span class="text-semibold"> {{ Session::get('message') }} .</span>
                                </div>
                        @endif
                        <!--Section fiche informations -->
                            <div class="col-lg-12" id="fiche-div">
                                <input type="hidden" name="client-action" value="true">
                            @csrf
                            <!-- Fiche Section-->
                                <div class="row">
                                    <input type="hidden" id="fiche_id" value="{{$fiche->id}}" name="fiche_id">
                                    @if(!empty($fiche->simulation))
                                        <input type="hidden" id="simulation_id" value="{{$fiche->simulation->id}}"
                                               name="simulation_id">
                                    @endif

                                    <select name="provenance_id" readonly id="provenance_id"
                                            class="bootstrap-select form-control form-control-sm hidden"
                                            style="padding: 8px;">
                                        <option value=""></option>
                                        @foreach($provenances as $provenance)
                                            <option @if($fiche->provenance->id == $provenance->id) selected
                                                    @endif value="{{$provenance->id}}"> {{$provenance->libelle}}
                                            </option>
                                        @endforeach
                                    </select>

                                    <input type="text" name="date_effet" readonly id="date_effet"
                                           class="date-picker form-control hidden"
                                           style="font-size: 20px; font-weight: bold;"
                                           value="{{$fiche->simulation != null ? Helper::getDateFormat($fiche->simulation->date_effet) : \Carbon\Carbon::now()->tomorrow()->format('d/m/Y') }}">

                                    <input type="hidden" readonly name="user_id" id="user_id"
                                           class="mt-m15 form-control"
                                           value="{{$fiche->user_id}}">
                                </div>
                                <!-- /Fiche Section-->

                                <!-- Prospect & Conjoint sections-->
                                <div class="row">
                                    @include('utilisateur.fiches.details-fiche-includes.prospect')

                                    @include('utilisateur.fiches.details-fiche-includes.conjoint')
                                </div>
                                <!--/Prospect & Conjoint sections-->

                                @include('utilisateur.fiches.details-fiche-includes.enfants')

                                @include('utilisateur.fiches.details-fiche-includes.details-prospect')
                            </div>
                            <!-- /Section fiche informations-->
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-offset-8 col-md-4">
                                <button type="button" class="btn-block update_fiche btn btn-primary btn-xs rounded0"><b><i
                                                class="icon-database-refresh"></i></b>&nbsp;&nbsp;
                                    &nbsp;Enregistrer
                                </button>
                            </div>
                        </div>
                        <!-- Footer -->
                    @include('includes.footer')
                    <!-- /footer -->
                    </div>
                </form>
                <!-- /content area -->
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->
@endsection