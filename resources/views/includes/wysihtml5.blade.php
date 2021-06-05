<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="{{asset('global-assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/core.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/components.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/colors.min.css')}}" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- Core JS files -->
<script src="{{asset('global-assets/js/plugins/loaders/pace.min.js')}}"></script>
<script src="{{asset('global-assets/js/core/libraries/jquery.min.js')}}"></script>
<script src="{{asset('global-assets/js/core/libraries/bootstrap.min.js')}}"></script>
<script src="{{asset('global-assets/js/plugins/loaders/blockui.min.js')}}"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="{{asset('global-assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script src="{{asset('global-assets/js/plugins/editors/wysihtml5/wysihtml5.min.js')}}"></script>
<script src="{{asset('global-assets/js/plugins/editors/wysihtml5/toolbar.js')}}"></script>
<script src="{{asset('global-assets/js/plugins/editors/wysihtml5/parsers.js')}}"></script>
<script src="{{asset('global-assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js')}}"></script>


<script src="{{asset('global-assets/js/demo_pages/editor_wysihtml5.js')}}"></script>

<script src="{{asset('global-assets/js/plugins/ui/ripple.min.js')}}"></script>
<!-- /theme JS files -->
@php
    {{
        if(!is_null($fiche->personne->conjoint())){
            $conjoint = \App\Personne::find($fiche->personne->conjoint()->id);
        }else{
            $conjoint = null;
        }
     }}
@endphp
<div class="modal-content rounded0">
    <div class="modal-body p-10">
        <div class="col-md-12">
            <div class="row">
                <form id="modal_tarif">
                    @csrf
                    <div class="col-md-12 modal-contenu">
                        <div class="content-group border-top-lg border-top-primary">
                            <div class="page-header page-header-default">
                                <!--section prospect & conjoint & enfants-->
                                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i
                                                class="icon-menu-open"></i></a>
                                    <ul class="breadcrumb formule-breadcrumb">

                                    </ul>

                                    <ul class="breadcrumb-elements">
                                        <li class="mt-10">
                                            <button type="button" class="text-bold close" data-dismiss="modal">
                                                &times;
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="page-header-content">
                                    <div class="row pt-20 pb-0">
                                        <div class="page-title p0 pb-10">
                                            <div class="col-md-12">
                                                <div class="col-md-8">
                                                    <div class="col-md-6">
                                                        <h5 class="mt-10">
                                                            <i class="icon-user position-left"></i>
                                                            <span class="text-semibold">{{$fiche->personne->nom." ".$fiche->personne->prenom}}
                                                                &nbsp;({{\Carbon\Carbon::parse($fiche->personne->date_naissance)->diff(\Carbon\Carbon::now())->format("%y ans")}}
                                                                )
                                                            </span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="text-custom-grey text-bold">
                                                                N° Sécurité sociale
                                                            </label>
                                                            <input type="hidden" name="prospect_id"
                                                                   value="{{$fiche->personne->id}}">
                                                            <input type="text" data-mask="9-99-99-99-999-999-99"
                                                                   name="tarif_numero_securite_sociale"
                                                                   id="tarif_numero_securite_sociale"
                                                                   value="{{$fiche->personne->numero_securite_sociale}}"
                                                                   class="mt-m15 form-control">
                                                            <span class="text-danger error-msg"
                                                                  id="error_tarif_numero_securite_sociale">
                                                          <strong class="text-danger"></strong>
                                                    </span>
                                                        </div>
                                                    </div>
                                                    @if(!empty($conjoint))
                                                        <div class="col-md-6">
                                                            <h5 class="mt-10">
                                                                <i class="icon-user position-left"></i>
                                                                <span class="text-semibold">{{$conjoint->nom." ".$conjoint->prenom}}
                                                                    &nbsp;({{\Carbon\Carbon::parse($conjoint->date_naissance)->diff(\Carbon\Carbon::now())->format("%y ans")}}
                                                                    )
                                                                </span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">
                                                                    N° Sécurité sociale conjoint
                                                                </label>
                                                                <input type="hidden" name="conjoint_id"
                                                                       value="{{$conjoint->id}}">
                                                                <input type="text"
                                                                       data-mask="9-99-99-99-999-999-99"
                                                                       name="tarif_numero_securite_sociale_conjoint"
                                                                       id="tarif_numero_securite_sociale_conjoint"
                                                                       class="mt-m15 form-control"
                                                                       value="{{$conjoint->numero_securite_sociale}}">
                                                                <span class="text-danger error-msg"
                                                                      id="error_date_effet">
                                                                          <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    @php
                                                        $enfants = $fiche->personne->enfants();
                                                        $enfants_counter=0;
                                                    @endphp
                                                    @if($fiche->personne->enfants()!=null)
                                                        @foreach($enfants as $enfant)
                                                            @php
                                                                $enfants_counter++;
                                                            @endphp
                                                            <div class="form-group">
                                                                <label>Enfant {{$enfants_counter}} : Ayant droit
                                                                    <b>{{ucfirst($enfant->ayant_droit)}}</b>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                </div>
                                            </div>
                                            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                                        </div>


                                    </div>
                                </div>
                                <!--/section prospect & conjoint & enfants-->

                                <!--section Compte Paiement-->
                                <div class="breadcrumb-line" style="border-bottom: 1px solid lightgray;">
                                    <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                                    <ul class="breadcrumb">
                                        <li class="text-bold">
                                            <i class="icon-coins position-left"></i>
                                            Paiement
                                        </li>
                                    </ul>

                                    <ul class="breadcrumb-elements hidden">
                                        <li class="mt-10">
                                            <button type="button" class="text-bold close" data-dismiss="modal">
                                                &times;
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="page-header-content">
                                    <div class="row pt-15 pb-20">
                                        <div class="col-md-12" id="">
                                            <div class="col-md-3">
                                                <b class="paiement-compte-infos">
                                                    {{$fiche->compte->nom." ".$fiche->compte->prenom}}
                                                </b>
                                            </div>
                                            <div class="col-md-4">
                                                IBAN :
                                                <b class="paiement-compte-iban">
                                                    @if($fiche->compte != null)
                                                        {{$fiche->compte->iban}}
                                                    @endif
                                                </b>
                                            </div>

                                            <div class="col-md-4">
                                                Banque :
                                                <b class="paiement-banque-nom-section">
                                                    @if($fiche->compte != null)
                                                        {{$fiche->compte->banque->nom}}
                                                    @endif
                                                </b>
                                            </div>

                                            <div class="col-md-1">
                                                <i id="update-paiement-infos" title="Modifier"
                                                   class="cursor-pointer text-warning-600 icon-pencil3"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/section Compte Paiement-->

                                <!--section Editor-->
                                <div class="breadcrumb-line" style="border-bottom: 1px solid lightgray;">
                                    <a class="breadcrumb-elements-toggle"><i
                                                class="icon-menu-open"></i></a>
                                    <ul class="breadcrumb">
                                        <li class="text-bold">
                                            <i class="icon-city position-left"></i>
                                            Wisy
                                        </li>
                                    </ul>

                                    <ul class="breadcrumb-elements hidden">
                                        <li class="mt-10">
                                            <button type="button" class="text-bold close" data-dismiss="modal">
                                                &times;
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="page-header-content">
                                    <div class="row pt-15 pb-20">
                                        <div class="col-md-12">
                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">Full featured editor</h5>
                                                    <div class="heading-elements">
                                                        <ul class="icons-list">
                                                            <li><a data-action="collapse"></a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="panel-body">
                                                    <p class="content-group">WYSIHTML55 takes a textarea and transforms
                                                        it into a rich text editor. The textarea acts as a fallback for
                                                        unsupported browsers (eg. IE &lt; 8). Make sure the textarea
                                                        element has an <code>id</code>, so we can later access it easily
                                                        from javascript. The resulting rich text editor will much behave
                                                        and look like the textarea since behavior (placeholder,
                                                        autofocus, ...) and css styles will be copied over.</p>

                                                    <form action="#">
                                                        <div class="form-group">
									<textarea cols="18" rows="18" class="wysihtml5 wysihtml5-default form-control"
                                              placeholder="Enter text ...">
<h1>WYSIHTML5 - A better approach to rich text editing</h1>
<p>wysihtml5 is an <span class="wysiwyg-color-green"><a rel="nofollow" target="_blank"
                                                        href="https://github.com/xing/wysihtml5">open source</a></span> rich text editor based on HTML5 technology and the progressive-enhancement approach.
It uses a sophisticated security concept and aims to generate fully valid HTML5 markup by preventing unmaintainable tag soups and inline styles.</p>

<h2>Features</h2>

<ul>
	<li>It's fast and lightweight (smaller than TinyMCE, Aloha, ...)</li>
	<li>Auto-linking of urls as-you-type</li>
	<li>Generates valid and semantic HTML5 markup (even when the content is pasted from MS Word)</li>
	<li>Uses class names instead of inline styles</li>
	<li>Unifies line break handling across browsers</li>
	<li>Uses sandboxed iframes in order to prevent identity theft through XSS</li>
	<li>Speech-input for Chrome</li>
</ul>

<h2>Browser Support</h2>

<ul>
	<li><img width="24" alt="" src="http://xing.github.com/wysihtml5/img/icn_firefox.png" height="24"> Firefox 3.5+</li>
	<li><img width="24" alt="" src="http://xing.github.com/wysihtml5/img/icn_chrome.png" height="24"> Chrome</li>
	<li><img width="24" alt="" src="http://xing.github.com/wysihtml5/img/icn_internet_explorer.png"
             height="24"> IE 8+</li>
	<li><img width="24" alt="" src="http://xing.github.com/wysihtml5/img/icn_safari.png" height="24"> Safari 4+</li>
	<li><img width="24" alt="" src="http://xing.github.com/wysihtml5/img/icn_ios.png" height="24"> Safari on iOS 5+</li>
	<li><img width="24" alt="" src="http://xing.github.com/wysihtml5/img/icn_opera.png" height="24"> Opera 11+</li>
	<li><strong>Graceful degradation:</strong> Unsupported browsers will get a textarea</li>
</ul>
									</textarea>
                                                        </div>

                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Submit
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/section Editor-->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="rounded0 btn btn-link" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn-send-tarif rounded0 btn btn-primary">Enregistrer</button>
        <button type="button" class="btn-send-devis-tarif rounded0 btn btn-info">Enregistrer et Envoyer Devis
        </button>
    </div>
</div>