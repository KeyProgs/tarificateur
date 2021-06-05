<?php

namespace App\Http\Controllers;


use App\Banque;
use App\Compte;
use App\Details_personne;
use App\Fiche;
use App\Fiche_etat;
use App\Formule;
use App\Helpers\Helper;
use App\Historique;
use App\Http\Controllers\GlobaleController as GlobaleController;
use App\Personne;
use App\Personne_personne;
use App\Simulation;
use App\Sous_volet;
use App\Type_assurance;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UtilisateurController extends GlobaleController {

   private $civilites;
   private $regimes;
   private $situation_familiales;
   private $provenances;
   private $users;

   public function __construct() {
      $this->middleware('auth');
      $this->civilites = $this->listeCivilites();
      $this->regimes = $this->listeRegimes();
      $this->situation_familiales = $this->listeSituationFamiliales();
      $this->provenances = $this->listeProvenances();
      $this->users = $this->listeUsers();
   }

   public function myconnexion() {
      //return view('auth.connexion');
   }

   //nouvelle fiche forme
   public function nouvelleFicheForm() {
      $civilites = $this->civilites;
      $regimes = $this->regimes;
      $situation_familiales = $this->situation_familiales;
      $provenances = $this->provenances;
      $users = $this->users;
      return view('utilisateur.fiches.nouvelle-fiche', compact('users', 'provenances', 'situation_familiales', 'regimes', 'professions', 'civilites'));
   }

   //l'ajout d'une nouvelle fiche
   public function nouvelleFiche(Request $request) {

      $request->merge(['date_naissance' => Helper::setDateFormat($request->date_naissance)]);
      $request->merge(['conjoint_date_naissance' => Helper::setDateFormat($request->conjoint_date_naissance)]);
      $request->merge(['date_effet' => Helper::setDateFormat($request->date_effet)]);

      //change telephone_1
      $request->merge(['telephone_1' => str_replace('-', '', $request->telephone_1)]);
      $request->merge(['telephone_2' => str_replace('-', '', $request->telephone_2)]);
      $request->merge(['telephone_3' => str_replace('-', '', $request->telephone_3)]);

      $conjointId = $personneId = $personneDetailsId = null;
      $enfantsIds = array();

      //validation
      $rules = [
         'provenance_id' => 'required',
         'user_id' => 'required',
         'date_effet' => 'required|date',
         'civilite_id' => 'required',
         'nom' => 'required',
         'prenom' => 'required',
         'date_naissance' => 'required|date',
         'regime_id' => 'required',
         'conjoint_civilite_id' => 'required_with:has_conjoint',
         'conjoint_nom' => 'required_with:has_conjoint',
         'conjoint_prenom' => 'required_with:has_conjoint',
         'conjoint_date_naissance' => 'nullable|required_with:has_conjoint|date',
         'conjoint_regime_id' => 'required_with:has_conjoint',
         'code_postal' => 'required',
         'ville_id' => 'required',
         'telephone_1' => 'required'
      ];
      //validation des inputs enfants
      if($request->count_enfants != "0") {
         for($i = 1; $i <= $request->count_enfants; $i++) {
            //$rules['nom_en_' . $i] = 'required';
            //$rules['prenom_en_' . $i] = 'required';
            //$rules['sexe_en_' . $i] = 'required';
            $rules['date_naissance_en_' . $i] = 'required|date';
            $rules['ayant_droit_en_' . $i] = 'required';
            //$rules['numero_securite_social_en_' . $i] = 'required';
         }
      }
      $validator = Validator::make($request->all(), $rules);

      if($validator->fails()) {
         return response()->json(['errors' => $validator->errors()]);
      } else {
         try {
            DB::beginTransaction();
            //création du prospect
            $personneId = Personne::create($request->all())->id;

            //création details personne
            $personneDetailsId = Details_personne::create(array_merge($request->all(), ['personne_id' => $personneId]))->id;

            //création du conjoint
            if($request->has_conjoint == "1" && !empty($personneId)) {
               $conjointId = Personne::create([
                  'civilite_id' => $request->conjoint_civilite_id,
                  'nom' => $request->conjoint_nom,
                  'prenom' => $request->conjoint_prenom,
                  'date_naissance' => $request->conjoint_date_naissance,
                  'regime_id' => $request->conjoint_regime_id,
                  'activite' => $request->conjoint_activite,
                  'situation_familiale_id' => $request->conjoint_situation_familiale_id,
                  'numero_securite_sociale' => $request->conjoint_numero_securite_sociale,
                  'numero_affiliation' => $request->conjoint_numero_affiliation
               ])->id;
               Personne_personne::create(['personne_id' => $personneId, 'personne_concerne_id' => $conjointId, 'type_relation' => 'conjoint']);
            }

            //création des enfants
            if($request->count_enfants != "0") {
               for($i = 1; $i <= $request->count_enfants; $i++) {
                  //dd($request->{'nom_en_' . $i});
                  $regime_id = $civilite_id = $numero_affiliation = null;
                  if($request->{'ayant_droit_en_' . $i} === "Prospect") {
                     $regime_id = $request->regime_id;
                     $numero_affiliation = $request->numero_affiliation;
                  }
                  if($request->{'ayant_droit_en_' . $i} === "Conjoint") {
                     $regime_id = $request->conjoint_regime_id;
                     $numero_affiliation = $request->conjoint_numero_affiliation;
                  }
                  if($request->{'sexe_en_' . $i} == "M") {
                     $civilite_id = 1;
                  } else {
                     $civilite_id = 2;
                  }
                  $date_anissance_enfant = 'date_naissance_en_' . $i;
                  $request->merge([$date_anissance_enfant => Helper::setDateFormat($request->{'date_naissance_en_' . $i})]);

                  $enfantId = Personne::create([
                     'nom' => $request->{'nom_en_' . $i},
                     'prenom' => $request->{'prenom_en_' . $i},
                     'date_naissance' => $request->{'date_naissance_en_' . $i},
                     'regime_id' => $regime_id,
                     'civilite_id' => $civilite_id,
                     'activite' => NULL,
                     'numero_affiliation' => $numero_affiliation,
                     'numero_securite_sociale' => $request->{'numero_securite_social_en_' . $i},
                     'situation_familiale_id' => NULL,
                  ])->id;
                  //TODO : check ayant for Personne_personne table

                  if($request->{'ayant_droit_en_' . $i} === "Prospect") {
                     Personne_personne::create(['personne_id' => $personneId, 'personne_concerne_id' => $enfantId, 'type_relation' => 'enfant']);
                  }
                  if($request->{'ayant_droit_en_' . $i} === "Conjoint") {
                     Personne_personne::create(['personne_id' => $conjointId, 'personne_concerne_id' => $enfantId, 'type_relation' => 'enfant']);
                  }
                  array_push($enfantsIds, $enfantId);
               }
            }

            //fiche création
            //$ficheId = Fiche::create(array_merge($request->all(), ['personne_id' => $personneId, 'etat_id' => 1, 'sous_etat_id' => 1, 'equipes_autorisees' => '']))->id;
            $ficheId = Fiche::create(['provenance_id' => $request->provenance_id, 'user_id' => Auth::user()->id, 'date_rappel' => null, 'personne_id' => $personneId, 'date_effet' => $request->date_effet, 'etat_id' => 1, 'equipes_autorisees' => ''])->id;

            //$simulationId = Simulation::create(['user_id' => Auth::user()->id, 'type_assurance_id' => 1, 'fiche_id' => $ficheId, 'date_effet' => $request->date_effet])->id;

            Historique::create(['user_id' => Auth::user()->getAuthIdentifier(), 'fiche_id' => $ficheId, 'action_id' => 1, 'vue' => FALSE]);
            Session::flash('message', 'Votre demande a été bien traitée');
            Session::flash('alert-class', 'alert-success');

            if($request->commentaire != "") {
               Historique::create(['user_id' => Auth::user()->getAuthIdentifier(), 'fiche_id' => $ficheId, 'action_id' => 3, 'description' => $request->commentaire, 'vue' => FALSE]);
            }
            DB::commit();
            Session::flash('message', 'Votre demande a été bien traitée');
            Session::flash('alert-class', 'alert-success');
            return $this->sendResponse($ficheId, 'Votre demande a été bien traitée');
         } catch(\Exception $e) {
            DB::rollback();
            return $this->sendResponse($e->getMessage(), '');
         }


      }
   }

   //liste des fiches fraiches
   public function listeFichesViewByEtat($id, $rappel = null) {
      $etat = Fiche_etat::findOrfail($id);
      return view('utilisateur.fiches.fiches', compact('etat', 'rappel'));
   }

   public function tableFichesEtat(Request $request, $rappel = null) {
      $datasearch['etat'] = $request->input1;
      $datasearch['telephone'] = $request->input1;
      $datasearch['nom'] = $request->input1;
      $datasearch['prenom'] = $request->input1;
      $datasearch['email'] = $request->input1;
      $datasearch['adresse'] = $request->input1;
      $datasearch['commentaire'] = $request->input1;
      if(isset($_GET['alletat'])) $alletat = $_GET['alletat']; else $alletat = 'false';

      //dd($datasearch);
      $data = $this->getFichesIds($request->etat_id, $datasearch, $alletat, $request->rappel);
      $fiches = Fiche::whereIn('id', $data)
         ->orderBy('created_at', 'DESC')
         ->paginate(20);
      return view('utilisateur.fiches.table-fiches', compact('fiches'));
   }

   //form modification fiche
   public function modificationFicheForm($id) {
      $civilites = $this->civilites;
      $regimes = $this->regimes;
      $situation_familiales = $this->situation_familiales;
      $provenances = $this->provenances;
      $users = $this->users;
      //$user = User::findOrFail();
      $user = new User();
      $fiche = Fiche::whereIn('user_id', $user->getUsersEquipeByUser(Auth::user()->id))
         ->where('id', '=', $id)
         ->first();
      if(is_null($fiche)) {
         abort(403);
      }
      $types_assurance = Type_assurance::all();
      return view('utilisateur.fiches.details-fiche', compact('types_assurance', 'fiche', 'users', 'regimes', 'civilites', 'situation_familiales', 'provenances'));
   }

   //modification fiche
   public function modificationFiche(Request $request) {
      $user_type = $user_id = null;
      if($request->has('client-action')) {
         $user_type = 'personne_id';
         $user_id = $request->personne_id;
      } else {
         $user_type = 'user_id';
         $user_id = $request->user_id;
      }
      $request->merge(['date_naissance' => Helper::setDateFormat($request->date_naissance)]);
      $request->merge(['conjoint_date_naissance' => Helper::setDateFormat($request->conjoint_date_naissance)]);
      $request->merge(['date_effet' => Helper::setDateFormat($request->date_effet)]);

      //change telephone_1
      $request->merge(['telephone_1' => str_replace('-', '', $request->telephone_1)]);
      $request->merge(['telephone_2' => str_replace('-', '', $request->telephone_2)]);
      $request->merge(['telephone_3' => str_replace('-', '', $request->telephone_3)]);


      $rules = [
         'provenance_id' => 'required',
         'date_rappel' => 'required_if:etat_id,==,21',
         'user_id' => 'required',
         'date_effet' => 'required|date',
         'civilite_id' => 'required',
         'nom' => 'required',
         'prenom' => 'required',
         'date_naissance' => 'required|date',
         'regime_id' => 'required',
         'code_postal' => 'required',
         'ville_id' => 'required',
         'telephone_1' => 'required'
      ];

      if($request->has_conjoint == "1") {
         $rules['conjoint_civilite_id'] = 'required_with:has_conjoint';
         $rules['conjoint_nom'] = 'required_with:has_conjoint';
         $rules['conjoint_prenom'] = 'required_with:has_conjoint';
         $rules['conjoint_date_naissance'] = 'required_with:has_conjoint|date';
         $rules['conjoint_regime_id'] = 'required_with:has_conjoint';
      }

      if($request->count_enfants != "0") {
         for($i = 1; $i <= $request->count_enfants; $i++) {
            if($request->has('date_naissance_en_' . $i)) {
               $date_anissance_enfant = 'date_naissance_en_' . $i;
               $request->merge([$date_anissance_enfant => Helper::setDateFormat($request->{'date_naissance_en_' . $i})]);

               $rules['date_naissance_en_' . $i] = 'required|date';
               $rules['ayant_droit_en_' . $i] = 'required|in:Prospect,Conjoint';
            }
         }
      }

      $validator = Validator::make($request->all(), $rules);

      if($validator->fails()) {
         return response()->json(['errors' => $validator->errors()]);
      } else {
         try {
            DB::beginTransaction();
            $personne = Personne::findOrFail($request->personne_id);
            $personne->update($request->all());
            //modification du conjoint
            if($request->has_conjoint == "1" && $personne->exists) {
               $data_conjoint = [
                  'civilite_id' => $request->conjoint_civilite_id,
                  'nom' => $request->conjoint_nom,
                  'prenom' => $request->conjoint_prenom,
                  'date_naissance' => $request->conjoint_date_naissance,
                  'regime_id' => $request->conjoint_regime_id,
                  'activite' => $request->conjoint_activite,
                  'situation_familiale_id' => $request->conjoint_situation_familiale_id,
                  'numero_securite_sociale' => $request->conjoint_numero_securite_sociale,
                  'numero_affiliation' => $request->conjoint_numero_affiliation
               ];
               if(!empty($personne->conjoint()->id)) {
                  $conjoint = Personne::findOrFail($request->conjoint_id);
                  $conjoint->update($data_conjoint);
               } else {
                  $conjointId = Personne::create($data_conjoint)->id;
                  Personne_personne::create(['personne_id' => $personne->id, 'personne_concerne_id' => $conjointId, 'type_relation' => 'conjoint']);
               }

            } else {
               if(!empty($personne->conjoint()->id)) {
                  $idc = $personne->conjoint()->id;
                  $conjoint = Personne::findOrFail($personne->conjoint()->id);
                  $conjoint->delete();

                  Personne_personne::where('personne_id', '=', $personne->id)
                     ->where('personne_concerne_id', '=', $idc)
                     ->where('type_relation', '=', 'conjoint')
                     ->delete();
               }
            }
            //modification details personnes
            $details_personne = Details_personne::findOrFail($personne->details->id);
            $details_personne->update(array_merge($request->all(), ['personne_id' => $personne->id]));

            //modification fiche
            $fiche = Fiche::findOrFail($request->fiche_id);
            $fiche->update($request->all());

            //modification simulation


            /*if ($request->simulation_id != null) {
                $simulation = Simulation::findOrfail($request->simulation_id);
                $simulation->update(['user_id' => $request->user_id, 'date_effet' => $request->date_effet]);
            } else {
                Simulation::create(['fiche_id' => $request->fiche_id, 'user_id' => $request->user_id, 'date_effet' => $request->date_effet, 'type_assurance_id' => 1]);
            }*/


            //modification enfants
            $enfants_actuelles = $personne->enfants();
            $new_enfants = [];
            for($i = 1; $i <= $request->count_enfants; $i++) {
               $regime_id = $civilite_id = $numero_affiliation = null;

               if($request->{'ayant_droit_en_' . $i} === "Prospect") {
                  $regime_id = $request->regime_id;
                  $numero_affiliation = $request->numero_affiliation;
               } elseif($request->{'ayant_droit_en_' . $i} === "Conjoint") {
                  $regime_id = $request->conjoint_regime_id;
                  $numero_affiliation = $request->conjoint_numero_affiliation;
               } else {
                  $regime_id = 0;
                  $numero_affiliation = 0;
               }
               if($request->{'sexe_en_' . $i} == "M") {
                  $civilite_id = 1;
               } else {
                  $civilite_id = 2;
               }
               if($request->has('id_en_' . $i) && $request->{'id_en_' . $i} != "") {
                  $enfant = Personne::findOrFail($request->{'id_en_' . $i});
                  $enfant->update([
                     'nom' => $request->{'nom_en_' . $i},
                     'prenom' => $request->{'prenom_en_' . $i},
                     'date_naissance' => $request->{'date_naissance_en_' . $i},
                     'regime_id' => $regime_id,
                     'civilite_id' => $civilite_id,
                     'activite' => NULL,
                     'numero_affiliation' => $numero_affiliation,
                     'numero_securite_sociale' => $request->{'numero_securite_social_en_' . $i},
                     'situation_familiale_id' => NULL,
                  ]);
                  array_push($new_enfants, (int)$request->{'id_en_' . $i});
                  $id_relation = $request{'relation_en_' . $i};
                  $relation = Personne_personne::findOrFail($id_relation);

                  if($request->{'ayant_droit_en_' . $i} === "Prospect") {
                     $relation->update(['personne_id' => $personne->id, 'personne_concerne_id' => $request->{'id_en_' . $i}]);
                  }
                  if($request->{'ayant_droit_en_' . $i} === "Conjoint") {
                     $relation->update(['personne_id' => $conjoint->id, 'personne_concerne_id' => $request->{'id_en_' . $i}]);
                  }
               } else {
                  if($request->has('date_naissance_en_' . $i)) {
                     $enfantId = Personne::create([
                        'nom' => $request->{'nom_en_' . $i},
                        'prenom' => $request->{'prenom_en_' . $i},
                        'date_naissance' => $request->{'date_naissance_en_' . $i},
                        'regime_id' => $regime_id,
                        'civilite_id' => $civilite_id,
                        'activite' => NULL,
                        'numero_affiliation' => $numero_affiliation,
                        'numero_securite_sociale' => $request->{'numero_securite_social_en_' . $i},
                        'situation_familiale_id' => NULL,
                     ])->id;
                     array_push($new_enfants, $enfantId);
                     if($request->{'ayant_droit_en_' . $i} === "Prospect") {
                        Personne_personne::create(['personne_id' => $personne->id, 'personne_concerne_id' => $enfantId, 'type_relation' => 'enfant']);
                     }
                     if($request->{'ayant_droit_en_' . $i} === "Conjoint") {
                        Personne_personne::create(['personne_id' => $conjoint->id, 'personne_concerne_id' => $enfantId, 'type_relation' => 'enfant']);
                     }
                     //array_push($enfantsIds, $enfantId);
                  }
               }
            }
            Historique::create([$user_type => $user_id, 'fiche_id' => $request->fiche_id, 'action_id' => 2, 'vue' => false]);
            if($request->commentaire != "") {
               Historique::create([$user_type => $user_id, 'fiche_id' => $request->fiche_id, 'action_id' => 3, 'description' => $request->commentaire, 'vue' => false]);
            }


            if(!empty($enfants_actuelles)) {
               foreach($enfants_actuelles as $enfant) {
                  if(!in_array($enfant->id, $new_enfants)) {
                     $idEnfantToDelete = $enfant->id;
                     $enfant->delete();
                     Personne_personne::where('personne_concerne_id', '=', $idEnfantToDelete)
                        ->where('type_relation', '=', 'enfant')
                        ->delete();
                  }
               }
            }
            DB::commit();
            return $this->sendResponse('', 'Votre demande a été bien traitée');
         } catch(\Exception $e) {
            DB::rollback();
            return $this->sendError($e->getMessage());
         }
      }
   }

   //suppression enfant
   public function suppressionEnfant(Request $request) {
      Personne::where('id', '=', $request->id)->delete();
      Personne_personne::where('personne_concerne_id', '=', $request->id)->delete();
   }

   public function fichesByIdEtatJson($id, $data = null) {
      $fiches = Fiche::where('fiche_id', '=', $data)
         ->get();
      return DataTables::of($fiches)
         ->addColumn('personne_infos', function($fiches) {
            $html = "";
            $html .= '<b><a href="' . url("fiche-details") . '/' . $fiches->id . '">' . strtoupper($fiches->personne->nom . ' ' . $fiches->personne->prenom) . '</a></b></br>' .
               Carbon::parse($fiches->personne->date_naissance)->diff(\Carbon\Carbon::now())->format('%y ans');
            if(!empty($fiches->personne->conjoint()[0])) {
               $html .= '</br>Conjoint : <b>' . $fiches->personne->conjoint()[0]->nom . ' ' . $fiches->personne->conjoint()[0]->prenom . '</b>';
            }
            if(!empty($fiches->personne->enfants()[0])) {

               if(!empty($fiches->personne->conjoint()[0])) {
                  $html .= '</br>Nbr d\'enfants : ' . (sizeof($fiches->personne->enfants()) + sizeof(Personne::find($fiches->personne->conjoint()[0]->id)->enfants()));
               } else {
                  $html .= '</br>Nbr d\'enfants : ' . sizeof($fiches->personne->enfants());
               }

            }
            return $html;
         })
         ->addColumn('adresse_postale', function($fiches) {
            $html = $fiches->personne->details->ville . ' (' . $fiches->personne->details->code_postal . ')</br>' . $fiches->personne->details->adresse;
            return $html;
         })
         ->addColumn('contact', function($fiches) {
            $html = '';
            if(!empty($fiches->personne->details->email)) {
               $html = ucfirst($fiches->personne->details->email) . '</br>';
            }
            if(!empty($fiches->personne->details->telephone_1)) {
               $html .= $fiches->personne->details->telephone_1 . '  <i title="Appeler" class="text-size-base cursor-pointer btn-rounded icon-phone2"></i></br>';
            }
            if(!empty($fiches->personne->details->telephone_2)) {
               $html .= $fiches->personne->details->telephone_2 . '  <i title="Appeler" class="text-size-base cursor-pointer icon-phone2"></i></br>';
            }
            if(!empty($fiches->personne->details->telephone_3)) {
               $html .= $fiches->personne->details->telephone_3 . '  <i title="Appeler" class="text-size-base cursor-pointer icon-phone2"></i></br>';
            }
            return $html;
         })
         ->addColumn('etat', function($fiches) {
            $html = 'Inséré le : ' . $fiches->created_at->format('d/m/Y H:i') . '</br>' . 'Date d\'effet : ' . date('d/m/Y', strtotime(str_replace('-', '/', $fiches->date_effet))) . '</br><span class="text-bold text-success">' . $fiches->etat->valeur . '</span>';
            return $html;
         })
         ->addColumn('action', function($fiches) {
            return '<ul class="icons-list">
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                              <i class="icon-menu9"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-right">
                             <!-- <li ><a class="fiche_historique" id="' . $fiches->id . '" ><i class="icon-history"></i> voir l\'historique</a>
                              </li>-->
                              <li><a href="' . url("fiche-details") . '/' . $fiches->id . '"><i class="icon-file-text2"></i> voir les details
                                  </a>
                              </li>
                          </ul>
                      </li>
                  </ul>
                  <input type="hidden" id="fiche_id" class="fiche_id" value="' . $fiches->id . '">';
         })
         ->rawColumns(['personne_infos', 'adresse_postale', 'contact', 'etat', 'action'])
         ->setRowClass(function() {
            return 'yajra-tr';
         })
         ->make(true);
   }

   public function historiqueFiche(Request $request) {
      $fiche = Fiche::findOrFail($request->id);
      if(!empty($fiche)) {
         $historique_html = "";
         foreach($fiche->historique as $historique) {
            $user = null;
            if($historique->user != null) {
               $user = $historique->user->prenom . " " . $historique->user->nom;
            } else {
               $user = 'Client';
            }

            if($historique->action_id != "13" && Auth::user()->isRole('agent')) {

            }
            if(empty($historique->description)) {
               $historique_html .= '<ul class="media-list" >
                                                    <li class="media" >
                                                        <div class="media-left pr-5" ><a href = "#"
                                                                                        class="btn border-primary text-primary btn-flat btn-icon btn-sm" ><i
                                                                        class="icon-file-text3" ></i ></a ></div >
                                                        <div class="media-body" >
                                                            <a href = "#" >
                     ' . $historique->action->action . '</a >
                                                            <div class="text-size-base media-annotation " >
                                                            
                 ' .
                  $historique->created_at->format('d/m/Y H:i') . ' ' . $user
                  . '</div >
                                                        </div >
                                                    </li >
                                                </ul >';
            } else {

               $historique_html .= ' <ul class="media-list chat-list" >
                                                    <li class="media" >
                                                        <div class="media-left" >
                                                        </div >
                                                        <div class="media-body" >
                                                            <div class="media-content media-content-1 bg-blue-400 " >
                                                            
               ' . $historique->description . '
                                                            </div >
                                                            <span class="media-annotation display-block" >
                                                            
                ' . $historique->created_at->format('d/m/Y H:i') . ' ' . $user . '</span >
                                                        </div >
                                                    </li >
                                                </ul >';
            }

         }

         $html_response = '<div class="panel panel-flat border-top-lg border-top-primary" >
                                    <div class="breadcrumb-line " >
                                        <span class=" breadcrumb text-bold" ><i
                                                    class="icon-file-empty2 position-left" ></i > Fiche Historique </span >
                                        <div class="heading-elements" >
                                            <ul class="icons-list" >
                                                <li ><a data - action = "collapse" ></a ></li >
                                                <li ><a data - action = "reload" ></a ></li >
                                                <li ><a class="close-fiche-historique" ><i class="icon-cross" ></i ></a >
                                                </li >
                                            </ul >
                                        </div >
                                    </div >
                                    <div class="panel-body p-10" id = "fiche_historique_body" >


                                        ' . htmlspecialchars_decode($historique_html) . '

                                    </div >
                                    
                                </div> ';


         return $this->sendResponse($html_response, '');
      } else {
         return $this->sendError('Une erreur est survenue sur le script de cette page . ');
      }
   }


   public function getTarificateurFormules(Request $request, $IdsFormules = null) {
      $IdsFormules = explode(',', $IdsFormules);
      $garanties = null;

      $ArrayVolet = [];

      foreach($IdsFormules as $IdFormule) {
         $garanties[$IdFormule]['garanties'] = null;
         $formule = Formule::find($IdFormule);
         $GR = DB::table('valeurs')->join('formules', 'formules.id', '=', 'valeurs.formule_id')
            ->join('sous_volets', 'sous_volets.id', '=', 'valeurs.sous_volet_id')
            ->where('formules.id', '=', $IdFormule)
            ->select('formules.id as id', 'formules.nom as NomFormule', 'valeurs.valeur as garantie', 'sous_volets.valeur as sous_volet', 'sous_volets.id as sous_volet_id')
            ->get();
         //dd($GR);
         foreach($GR as $gr) {
            $garanties[$IdFormule]['garanties'][] = $gr;
         }
         $garanties['volets'] = [];
         $garanties[$IdFormule]['logo'] = $formule->gamme->logo;
         $garanties[$IdFormule]['IdFormule'] = $formule->id;
         $garanties[$IdFormule]['NomFormule'] = $formule->nom;
         $garanties[$IdFormule]['NomGamme'] = $formule->gamme->nom;
         $garanties[$IdFormule]['NomCompagnie'] = $formule->gamme->compagnie->nom;
         $garanties[$IdFormule]['prix'] = "";
         $volets = DB::table('volets')->select('volets.id', 'volets.valeur')->get();
         foreach($volets as $volet) {
            $v = new Volet();
            $listeSousVolets = $v->getSousVoletsById($volet->id);
            if($listeSousVolets !== NULL) {
               $listeSousVolets['height'] = 0;
               $ArrayVolet[$volet->valeur] = $listeSousVolets;
            }

            ///$ArrayVolet[$volet->valeur]['volet'] = $listeSousVolets;


         }

         $garanties['volets'] = $ArrayVolet;
         //dd($garanties);

         /*$volets = DB::table('volets')->select('volets.id', 'volets.valeur')->get();

        //liste sous volets ids
       $sousVoletsIds = DB::table('valeurs')->join('formules', 'formules.id', '=', 'valeurs.formule_id')
           ->join('sous_volets', 'sous_volets.id', '=', 'valeurs.sous_volet_id')
           ->where('formules.id', '=', $IdFormule)
           ->select('valeurs.sous_volet_id')
           ->get()->pluck('sous_volet_id')->toArray();

        foreach($volets as $volet) {
           $listeSousVolets = $this->getSousVoletsById($volet->id);
          if($listeSousVolets !== NULL) {
              //$volet->liste_sous_volet = $listeSousVolets;
              $ArrayVolet[$volet->id] = $listeSousVolets;
           }
        }

        $garanties[$IdFormule]['volets'] = $ArrayVolet;
        $garanties[$IdFormule]['logo'] = $formule->gamme->logo;
        $garanties[$IdFormule]['IdFormule'] = $formule->id;
        $garanties[$IdFormule]['NomFormule'] = $formule->nom;
        $garanties[$IdFormule]['NomGamme'] = $formule->gamme->nom;
        $garanties[$IdFormule]['NomCompagnie'] = $formule->gamme->compagnie->nom;
        $garanties[$IdFormule]['prix'] = "";*/


         //dd($ArrayVolet);
         /*$ArrayVolet;
         $volets;
         foreanch $volets as $volets
              get $sousvlet
              $ArrayVolet[$volets->id] = $sousvlet[];

         $garanties[$IdFormule]['volets'] = $ArrayVolet;*/
         /*$garanties[$IdFormule]['volets'] = DB::table('volets')->join('sous_volets', 'volets.id', '=', 'sous_volets.volet_id')
            ->join('valeurs', 'valeurs.sous_volet_id', '=', 'sous_volets.id')
            ->where('valeurs.formule_id', '=', $IdFormule)
            ->select('volets.id as volet_id', 'volets.valeur as volet_nom')
            ->get();

         $garanties[$IdFormule]['volets']['sous_volets'] = [];
         for($i = 0; $i < sizeof($garanties[$IdFormule]['volets']); $i++) {
            $sous_volet_data = DB::table('valeurs')->join('formules', 'formules.id', '=', 'valeurs.formule_id')
               ->join('sous_volets', 'sous_volets.id', '=', 'valeurs.sous_volet_id')
               ->where('formules.id', '=', $IdFormule)
               ->where('sous_volets.volet_id', '=', $garanties[$IdFormule]['volets'][$i]->volet_id)
               ->select('formules.id as id', 'formules.nom as NomFormule', 'valeurs.valeur as garantie', 'sous_volets.valeur as sous_volet', 'sous_volets.id as sous_volet_id')
               ->get();
            var_dump($garanties[$IdFormule]['volets'][$i]);*/


         /*if($sous_volet_data!=null){
            $garanties[$IdFormule]['volets']['sous_volets'] = $sous_volet_data;
         }*/
         //echo 'volet index : ' . $i . ' value is : ' . $garanties[$IdFormule]['volets'][$i]->volet_id . "<br>";
         //echo 'formule id  ' . $IdFormule . '<br>';


         // }

         //old_code


         //$garanties[$IdFormule]->id = 'okk';

      }

      //dd($garanties);
      return $this->sendResponse($garanties, '');

      //dd($garanties);
      /*$dataFormules = array();
      if(!empty($request->data)) {

         $formulesIds = $request->data;
         $formulesIds = explode(',', $formulesIds);

         $formules = DB::table('formules')->
         whereIn('formules.id', $formulesIds)
            ->join('gammes', 'gammes.id', '=', 'formules.gamme_id')
            ->join('compagnies', 'compagnies.id', '=', 'gammes.compagnie_id')
            ->join('valeurs', 'valeurs.formule_id', '=', 'formules.id')
            ->select('valeurs.valeur as garantie', 'formules.id as id', 'formules.id as id', 'gammes.nom as NomGamme', 'formules.nom as NomFormule', 'compagnies.nom as NomCompagnie', 'compagnies.logo')
            ->get();


         /*foreach($formulesIds as $fId) {
            $formule = Formule::find($fId);
            //$formule->gamme_data = $formule->gamme;
            //$formule->compagnie_data = $formule->gamme->compagnie;
            //$formule->type_assurance_data = $formule->gamme->type_assurance;
            //$formule->prix = "";
            array_push($dataFormules, $formule);
         }*/
      /*return $this->sendResponse($garanties, '');
   }
   return null;*/
   }


   public function getSousVolets($idFormule = null) {
      /*if($valeur!=null){
      }else{
      }*/
      $listeSousVolets = Sous_volet::orderBy('volet_id', 'ASC')->get();
      foreach($listeSousVolets as $sousVolet) {
         $sousVolet->nom_volet = $sousVolet->volet->valeur;
         if($idFormule != null) {
            $sousVolet->valeur = Valeur::where('formule_id', '=', $idFormule)
               ->where('sous_volet_id', '=', $sousVolet->id)->get()->pluck('valeur');
            // dd($sousVolet->garantie);
         }
      }
      return $this->sendResponse($listeSousVolets, '');
   }


   //modification profile utilisateur
   public function monProfile() {
      $user = User::findOrfail(Auth::user()->id);
      return view('utilisateur.profile.mon-profile', compact('user'));
   }

   public function modificationProfile(Request $request) {
      if(Auth::user()->id != $request->id) {
         abort(403);
      }
      $user = User::findOrfail($request->id);

      $this->validate($request, [
         'nom' => 'required|string|max:255',
         'prenom' => 'required|string|max:255',
         'adresse' => 'nullable|string|max:255',
         'telephone' => 'nullable|string|max:255',
         'titre' => 'nullable|string|max:255',
         'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
         'password' => 'nullable|string|min:6|confirmed'
      ]);

      if(!empty($request->password)) {
         //$password = Hash::make($request->password);
         $request->merge(array('password' => Hash::make($request->password)));
         $user->update($request->all());
      } else {
         $user->update($request->except('password'));
      }
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('/mon-profile');

   }

   //gestion des contrats
   public function gestionContratsIndex() {
      return view('utilisateur.contrats.liste-contrats');
   }

   public function listeContratsJson($month = null, $year = null) {

      /*$contrats = Fiche::where('fiche_id', '=', '')
        ->get();*/

      $etatsfichesContrats = Fiche_etat::where('etat_groupe_id', '=', '6')
         ->pluck('id');
      /*$fiches = Fiche::where('user_id', '=', Auth::user()->id)
         ->whereIn('id', $etatsfichesContrats)
         ->get();*/

      $devis = array();
      $user = \App\User::findOrFail(Auth::user()->id);
      //$user = \App\User::findOrFail(53);
      //$simulations = $user->simulations;
      $usersIds = $user->getUsersEquipeByUser($user->id);
      $simulations = Simulation::whereIn('user_id', $usersIds)->get();

      foreach($simulations as $simulation) {
         foreach($simulation->devis as $d) {
            $d->prospect = $d->simulation->fiche->personne->nom . " " . $d->simulation->fiche->personne->prenom;
            $d->user = $d->simulation->user->nom . " " . $d->simulation->user->prenom;
            $d->fiche_id = $d->simulation->fiche->id;
            $d->codification = $d->simulation->fiche->etat->id;
            //$d->codification = "test";
            if($month != null) {
               if(strpos($d->created_at, $year . "-" . $month) !== false) {
                  array_push($devis, $d);
               }
            } else {
               array_push($devis, $d);
            }

         }
      }

      return DataTables::of($devis)
         ->addColumn('action', function($devis) {
            return '<a title="Voir les details" href="' . url("fiche-details") . '/' . $devis->fiche_id . '"><i class="icon-file-text2"></i> 
                    </a>
                    <input type="hidden" id="devis_id" class="devis" value="' . $devis->id . '">';
         })
         ->addColumn('date_envoi', function($devis) {
            return $devis->created_at->format('d/m/Y H:i');
         })
         ->addColumn('cotisation', function($devis) {
            return number_format($devis->cotisation, 2) . " €";
         })
         ->addColumn('formule', function($devis) {
            return $devis->formule->nom;
         })
         ->addColumn('conseiller', function($devis) {
            return $devis->user;
         })
         ->addColumn('codification', function($devis) {
            return $devis->codification;
         })
         ->make(true);
   }

   //gestion des devis
   public function gestionDevisIndex() {
      return view('utilisateur.devis.liste-devis');
   }

   public function listeDevisJson($month = null, $year = null) {
      $devis = array();
      $user = User::findOrFail(Auth::user()->id);
      //$equipesIdsByUser = User_equipe::where('user_id', '=', )->pluck('equipe_id');
      $usersIds = $user->getUsersEquipeByUser($user->id);
      //dd($usersIds);
      foreach($usersIds as $id) {
         $user = User::where('id', '=', $id)->first();
         $simulations = $user->simulations;

         foreach($simulations as $simulation) {
            foreach($simulation->devis as $d) {
               $d->prospect = $d->simulation->fiche->personne->nom . " " . $d->simulation->fiche->personne->prenom;
               $d->user = $d->simulation->fiche->user->nom . ' ' . $d->simulation->fiche->user->prenom;
               $d->sender = $d->simulation->user->nom . ' ' . $d->simulation->user->prenom;
               $d->fiche_id = $d->simulation->fiche->id;
               if($month != null) {
                  if(strpos($d->created_at, $year . "-" . $month) !== false) {
                     array_push($devis, $d);
                  }
               } else {
                  array_push($devis, $d);
               }
            }
         }
      }

      return DataTables::of($devis)
         ->addColumn('action', function($devis) {
            return '<a title="Voir details fiches" href="' . url("fiche-details") . '/' . $devis->fiche_id . '"><i class="icon-file-text2"></i> 
                    </a>
                    <input type="hidden" id="devis_id" class="devis" value="' . $devis->id . '">';
         })
         ->addColumn('date_envoi', function($devis) {
            return $devis->created_at->format('d/m/Y H:i');
         })
         ->addColumn('cotisation', function($devis) {
            return number_format($devis->cotisation, 2) . " €";
         })
         ->addColumn('sendUser', function($devis) {
            return $devis->sender;
         })
         ->addColumn('user', function($devis) {
            return $devis->user;
         })->make(true);
   }

   public function getNotifications($parametre) {
      $user = Auth::user();
      $usersIds = $user->getUsersEquipeByUser($user->id);
      $notifs = Historique::where('vue', '=', 1)
         ->whereIn('user_id', $usersIds)
         ->get();
      foreach($notifs as $n) {
         $n->agent = $n->user;
      }
       $count = sizeof($notifs);
       if($parametre == "1") {
           return $this->sendResponse($notifs, $count);
       } else {
           return $this->sendResponse('', $count);
       }

   }

   public function checkUserNotification(Request $request) {
      $historique = Historique::where('id', '=', $request->id)->first();
      $user = Auth::user();
      if($user->isRole("admin")) {
         $historique->update(['vue' => '0']);
      }
      return $this->sendResponse($historique->id, '');
   }


   public function getRappels($parametre) {
      $current_date = Carbon::now();
      $current_date_15 = Carbon::now()->addMinute(15)->toDateTimeString();
      $user = Auth::user();
      $usersIds = $user->getUsersEquipeByUser($user->id);
      $fiches = Fiche::where('etat_id', '=', 21)
         ->whereIn('user_id', $usersIds)
         ->where('date_rappel', '>=', $current_date)
         ->where('date_rappel', '<=', $current_date_15)
         ->get();
      $count = sizeof($fiches);
      if($parametre == "1") {
         return $this->sendResponse($fiches, $count);
      } else {
         return $this->sendResponse('', $count);
      }
   }





   //'input' => 'min:10 | regex:/^\+33[\t][0 - 9]{
   /*1
   }

      -[0 - 9]{
      2}-[0 - 9]{
      2}-[0 - 9]{
      2}-[0 - 9]{
      2}$/',
      //+33 9-99-99-99-99

  //example of regex test
  //regex = /^\+1\([0-9]{3}\)-[0-9]{3}-[0-9]{4}$/
  //match to +1(320)-924-2043*/
}
