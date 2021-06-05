<?php

namespace App\Http\Controllers;

use App\Compagnie;
use App\Devis;
use App\Equipe;
use App\Formule;
use App\Gamme;
use App\Groupe_etat_role;
use App\Historique;
use App\Ip_adresse;
use App\Piece_jointe;
use App\Provenance;
use App\Regime;
use App\Role;
use App\Etat_groupe;
use App\Fiche;
use App\Fiche_etat;
use App\Simulation;
use App\Sous_volet;
use App\Template;
use App\Template_type;
use App\Type_assurance;
use App\User;
use App\User_equipe;
use App\User_type_assurance;
use App\Volet;
use App\Zone;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends GlobaleController {


   public function __construct() {
      $this->middleware('auth');
      $this->middleware('role');
      //$this->AuthUser = User::findOrFail('');
   }

   //liste des fiches fraiches
   public function listeFichesView() {
      return view('admin.fiches.fiches');
   }

   public function tableFiches(Request $request) {
      $datasearch['etat'] = $request->input1;
      $datasearch['telephone'] = $request->input1;
      $datasearch['nom'] = $request->input1;
      $datasearch['prenom'] = $request->input1;
      $datasearch['email'] = $request->input1;
      $datasearch['adresse'] = $request->input1;
      $datasearch['commentaire'] = $request->input1;
      $data = $this->getFichesIds(null, $datasearch, 'true');
      $fiches = Fiche::whereIn('id', $data)
         ->orderBy('created_at', 'DESC')
         ->paginate(20);
      return view('admin.fiches.table-fiches', compact('fiches'));
   }

   public function getUsersByRole() {
      $user = User::findOrFail(Auth::user()->id);
      $usersIds = $user->getUsersEquipeByUser($user->id);
      $users = User::whereIn('id', $usersIds)->get();
      $html_response = '<option value="" selected></option>';
      foreach($users as $user) {
         $html_response .= '<option value="' . $user->id . '" id="' . $user->id . '">' . $user->nom . '  ' . $user->prenom . '</option>';
      }
      return $this->sendResponse($html_response, '');
   }

   public function reaffectFiches(Request $request) {
      try {
         DB::beginTransaction();
         $user = User::find($request->conseiller);
         $description = 'fiche affecté pour ' . $user->nom . ' ' . $user->prenom;
         foreach($request->fiches as $ficheId) {
            $fiche = Fiche::find($ficheId);
            $fiche->changerUserTo($request->conseiller, $description);
            $fiche->save();
         }
         DB::commit();
         return $this->sendResponse('alert-success', sizeof($request->fiches) . ' fiches ont été réaffectés pour ' . $user->nom . ' ' . $user->prenom);
      } catch(\Exception $e) {
         return $this->sendResponse('alert-danger', 'Erreur : ' . $e->getMessage());
      }
   }

   public function getEtatsFichesByRole() {

      $html_response = '<option value="" selected></option>';
      $user = \App\User::findOrFail(\Illuminate\Support\Facades\Auth::user()->id);
      if($user->isRole('admin')) {
         $listEtats = Fiche_etat::all();
         foreach($listEtats as $etat) {
            $html_response .= $etat->libelle . '<br>';
            $html_response .= '<option value="' . $etat->id . '" id="' . $etat->id . '">' . $etat->libelle . '</option>';
         }
      } else {
         $userGroupeEtats = $user->role->etat_groupe;
         foreach($userGroupeEtats as $userGroupeEtat) {
            if(sizeof($userGroupeEtat->groupe_etat->fiche_etats) > 0) {
               $listEtats = $userGroupeEtat->groupe_etat->fiche_etats;
               foreach($listEtats as $etat) {
                  $html_response .= $etat->libelle . '<br>';
                  $html_response .= '<option value="' . $etat->id . '" id="' . $etat->id . '">' . $etat->libelle . '</option>';
               }
            }
         }
      }
      return $this->sendResponse($html_response, '');
   }

   public function changeFichesEtats(Request $request) {
      try {
         DB::beginTransaction();
         $etat = Fiche_etat::find($request->conseiller);
         $description = 'Changement de fiche etat vers : ' . $etat->libelle;
         foreach($request->fiches as $ficheId) {
            $fiche = Fiche::find($ficheId);
            $fiche->changerEtatTo($request->conseiller, $description);
            $fiche->save();
         }
         DB::commit();
         return $this->sendResponse('alert-success', 'l\'etat de ' . sizeof($request->fiches) . ' fiches a été changer vers ' . $etat->libelle);
      } catch(\Exception $e) {
         return $this->sendResponse('alert-danger', 'Erreur : ' . $e->getMessage());
      }
   }

   public function compagniesIndex() {
      $user = User::findOrFail(Auth::user()->id);
      if(!$user->isRole('admin')) {
         abort(403);
      }
      $compagnies = Compagnie::all();
      return view('admin.compagnies.liste-compagnies', compact('compagnies'));
   }

   public function nouvelleCompagnieForm() {
      return view('admin.compagnies.nouvelle-compagnie');
   }

   public function nouvelleCompagnie(Request $request) {
      $attributes = $request->all();
      $this->validate($request, [
         'nom' => 'required|string|max:255',
         'adresse1' => 'nullable|string',
         'adresse2' => 'nullable|string',
         'telephone1' => 'nullable|max:255',
         'telephone2' => 'nullable|max:255',
         'description' => 'nullable|string',
         'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:300',
      ]);
      if($request->hasFile('logo')) {
         $image = $request->file('logo');
         $fileName = time() . '-' . $image->getClientOriginalName();
         $destinationPath = public_path('/uploads/img/compagnies');
         $image->move($destinationPath, $fileName);
         $attributes['logo'] = $fileName;
      } else {
         $attributes['logo'] = "";
      }
      Compagnie::create($attributes);
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('/compagnies');

   }

   public function compagnieDetailsForm($id_compagnie) {
      $compagnie = Compagnie::findOrFail($id_compagnie);
      return view('admin.compagnies.details-compagnie', compact('compagnie'));
   }

   public function compagnieDetails(Request $request) {
      $attributes = $request->all();
      $this->validate($request, [
         'nom' => 'required|string|max:255',
         'adresse1' => 'nullable|string',
         'adresse2' => 'nullable|string',
         'telephone1' => 'nullable|max:255',
         'telephone2' => 'nullable|max:255',
         'description' => 'nullable|string',
         'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:300',
      ]);
      $compagnie = Compagnie::findOrFail($request->id);
      if($request->hasFile('logo')) {
         $image = $request->file('logo');
         $fileName = time() . '-' . $image->getClientOriginalName();
         $destinationPath = public_path('/uploads/img/compagnies');
         $image->move($destinationPath, $fileName);
         $attributes['logo'] = $fileName;
      }
      $compagnie->update($attributes);
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('/compagnie/' . $request->id);
   }

   public function compagnieSuppression($id_compagnie) {
      $compagnie = Compagnie::findOrFail($id_compagnie);
      if(sizeof($compagnie->piece_jointes) > 0 || sizeof($compagnie->gammes) > 0) {
         Session::flash('message', 'Vous ne pouvez pas supprimer ce élément !');
         Session::flash('alert-class', 'alert-warning');
      } else {
         $compagnie->delete();
         Session::flash('message', 'Votre demande a été bien traitée');
         Session::flash('alert-class', 'alert-success');
      }
      return redirect('/compagnies');
   }

   public function compagnieNouvelleGammeForm($id_compagnie) {
      $compagnie = Compagnie::findOrFail($id_compagnie);
      $type_assurances = Type_assurance::all();
      return view('admin.gammes.nouvelle-gamme', compact('compagnie', 'type_assurances'));
   }

   public function compagnieNouvelleGamme(Request $request, $id_compagnie) {
      if($id_compagnie != $request->compagnie_id) {
         abort(403);
      }
      $this->validate($request, [
         'nom' => 'required|string|max:255',
         'description' => 'nullable|string',
         'annee' => 'required|numeric',
         'e_age' => 'nullable|numeric',
         'e_age2' => 'nullable|numeric',
         'min_age' => 'nullable|numeric',
         'max_age' => 'nullable|numeric',
         'compagnie_id' => 'required',
         'type_assurance_id' => 'required'
      ]);
      Gamme::create($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('compagnie/' . $request->compagnie_id);
   }

   public function gammeDetailsForm($compagnie_id, $gamme_id) {
      $gamme = Gamme::findOrFail($gamme_id);
      if($gamme->compagnie->id != $compagnie_id) {
         abort(404);
      }
      $type_assurances = Type_assurance::all();
      $compagnies = Compagnie::all();
      return view('admin.gammes.details-gamme', compact('gamme', 'type_assurances', 'compagnies'));
   }

   public function gammeDetails(Request $request, $compagnie_id, $gamme_id) {
      if($request->id != $gamme_id) {
         abort(404);
      }
      $gamme = Gamme::findOrFail($gamme_id);
      $this->validate($request, [
         'nom' => 'required|string|max:255',
         'description' => 'nullable|string',
         'annee' => 'required|numeric',
         'e_age' => 'nullable|numeric',
         'e_age2' => 'nullable|numeric',
         'min_age' => 'nullable|numeric',
         'max_age' => 'nullable|numeric',
         'compagnie_id' => 'required',
         'type_assurance_id' => 'required'
      ]);
      $gamme->update($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('compagnie/' . $request->compagnie_id . '/gamme/' . $request->id);
   }

   public function gammeSuppression($compagnie_id, $gamme_id) {
      $gamme = Gamme::findOrFail($gamme_id);
      if(sizeof($gamme->piece_jointes) > 0 || sizeof($gamme->formules) > 0) {
         Session::flash('message', 'Vous ne pouvez pas supprimer ce élément !');
         Session::flash('alert-class', 'alert-warning');
      } else {
         $gamme->delete();
         Session::flash('message', 'Votre demande a été bien traitée');
         Session::flash('alert-class', 'alert-success');
      }
      return redirect()->back();
   }

   public function equipesIndex() {
      $equipes = null;
      $user = User::findOrFail(Auth::user()->id);
      if(!$user->isRole('admin') && !$user->isRole('supervisor') && !$user->isRole('chef_equipe')) {
         abort(403);
      } else {
         $user_equipes = User_equipe::where('user_id', '=', $user->id)->pluck('equipe_id')->toArray();
         if($user->isRole('admin')) {
            $equipes = Equipe::all();
         } else {
            $equipes = Equipe::whereIn("id", $user_equipes)->get();
         }

      }
      return view('admin.equipes.liste-equipes', compact('equipes'));
   }

   public function nouvelleEquipeForm() {
      if(!Auth::user()->isRole("admion")) {
         abort('403');
      }
      return view('admin.equipes.nouvelle-equipe');
   }

   public function nouvelleEquipe(Request $request) {
      if(!Auth::user()->isRole("admion")) {
         abort('403');
      }
      $request->validate([
         'nom' => 'required|max:255',
      ]);
      try {
         DB::beginTransaction();
         Equipe::create(array_merge($request->all(), ['valeur' => $request->nom, 'libelle' => $request->nom]));
         //Equipe::create(['valeur' => $request->nom, 'libelle' => $request->nom, 'description' => $request->description]);
         DB::commit();
         Session::flash('message', 'Votre demande a été bien traitée');
         Session::flash('alert-class', 'alert-success');
         return redirect('/nouvelle-equipe');
      } catch(\Exception $e) {
         Session::flash('message', $e->getMessage());
         Session::flash('alert-class', 'alert-warning');
         return redirect('/nouvelle-equipe');
      }
   }

   public function detailsEquipeForm($id) {
      if(!Auth::user()->isRole("admion")) {
         abort('403');
      }
      $equipe = Equipe::findOrfail($id);
      return view('admin.equipes.details-equipe', compact('equipe'));
   }

   public function detailsEquipe(Request $request) {
      if(!Auth::user()->isRole("admion")) {
         abort('403');
      }
      $request->validate([
         'nom' => 'required|max:255',
      ]);
      $equipe = Equipe::findOrFail($request->id);
      try {
         DB::beginTransaction();
         //$equipe->update(['valeur' => $request->nom, 'libelle' => $request->nom, 'description' => $request->description]);
         $equipe->update(array_merge($request->all(), ['valeur' => $request->nom, 'libelle' => $request->nom]));
         DB::commit();
         Session::flash('message', 'Votre demande a été bien traitée');
         Session::flash('alert-class', 'alert-success');
         return redirect('/equipe/' . $equipe->id);
      } catch(\Exception $e) {
         Session::flash('message', $e->getMessage());
         Session::flash('alert-class', 'alert-warning');
         return redirect('/equipe/' . $equipe->id);
      }
   }

   public function equipeUsersIndex($id) {
      $equipe = Equipe::findOrFail($id);
      $users = $equipe->users();
      return view('admin.equipes.liste-users-in-equipe', compact('equipe', 'users'));
   }

   public function nouveauUtilisateurForm() {
      $roles = null;
      $user = User::findOrFail(Auth::user()->id);
      $equipes = null;
      $user_equipes = User_equipe::where('user_id', '=', $user->id)->pluck('equipe_id')->toArray();
      if($user->isRole('admin')) {
         $equipes = Equipe::all();
         $roles = Role::all();
      } else {
         $equipes = Equipe::whereIn("id", $user_equipes)->get();
         $roles = Role::where('level', '<=', $user->role->level)->get();
      }
      $types_assurances = Type_assurance::all();
      return view('admin.equipes.nouveau-utilisateur', compact('types_assurances', 'roles', 'equipes'));
   }

   public function nouveauUtilisateur(Request $request) {

      $this->validate($request, [
         'nom' => 'required|string|max:255',
         'prenom' => 'required|string|max:255',
         'role_id' => 'required',
         'equipe_id' => 'required',
         'adresse' => 'nullable|string|max:255',
         'telephone' => 'nullable|string|max:255',
         'titre' => 'nullable|string|max:255',
         'email' => 'required|string|email|max:255|unique:users',
         'password' => 'required|string|min:6|confirmed',
      ]);

      $request->merge(array('password' => Hash::make($request->password)));
      $userId = User::create($request->all())->id;

      if(is_array($request->types_assurance)) {
         foreach($request->types_assurance as $type_id) {
            User_type_assurance::create(['user_id' => $userId, 'type_assurance_id' => $type_id]);
         }
      }

      if(is_array($request->equipe_id)) {
         foreach($request->equipe_id as $equipe_id) {
            User_equipe::create(['user_id' => $userId, 'equipe_id' => $equipe_id]);
         }
      }
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect()->back();
      //return redirect('/equipe/' . $request->equipe_id . '/users');
   }

   public function detailsUtilisateurForm($id, $user_id) {
      $equipes = null;
      $roles = null;
      $user_equipe = User_equipe::where('equipe_id', '=', $id)
         ->where('user_id', '=', $user_id)
         ->first();
      $user = User::findOrFail($user_id);
      $user_equipes = User_equipe::where('user_id', '=', $user->id)->pluck('equipe_id')->toArray();
      $authUser = User::findOrFail(Auth::user()->id);
      $auth_user_equipes = User_equipe::where('user_id', '=', $authUser->id)->pluck('equipe_id')->toArray();
      if($authUser->isRole('admin')) {
         $equipes = Equipe::all();
         $roles = Role::all();
      } else {
         $equipes = Equipe::whereIn("id", $auth_user_equipes)->get();
         $roles = Role::where('level', '<=', Auth::user()->role->level)->get();
      }


      $types_assurances = Type_assurance::all();
      $user_type_assurances = $user->user_type_assurance;
      $user_type_assurances_array = [];
      foreach($user_type_assurances as $type_assurance) {
         array_push($user_type_assurances_array, $type_assurance->type_assurance_id);
      }
      return view('admin.equipes.details-utilisateur', compact('types_assurances', 'user_type_assurances_array', 'user_equipe', 'user_equipes', 'user', 'roles', 'equipes'));
   }

   public function detailsUtilisateur(Request $request) {
      $user = User::findOrfail($request->id);
      $this->validate($request, [
         'nom' => 'required | string | max:255',
         'prenom' => 'required | string | max:255',
         'role_id' => 'required',
         'equipe_id' => 'required',
         'adresse' => 'nullable | string | max:255',
         'telephone' => 'nullable | string | max:255',
         'titre' => 'nullable | string | max:255',
         'email' => 'required | string | email | max:255 | unique:users,email,' . $request->id,
         'password' => 'nullable | string | min:6 | confirmed'
      ]);
      //suppression user types assurance
      $user_type_assurances = $user->user_type_assurance;
      if(is_array($user_type_assurances)) {
         foreach($user_type_assurances as $type) {
            $type->delete();
         }
      }
      //suppression user equipes
      $user_equipes = User_equipe::where('user_id', '=', $user->id)->get();

      if(!empty($user_equipes)) {
         foreach($user_equipes as $user_equipe) {
            $user_equipe->delete();
         }
      }
      //l'ajout des equipes user
      if(!empty($request->equipe_id)) {
         foreach($request->equipe_id as $equipe_id) {
            User_equipe::create(['user_id' => $user->id, 'equipe_id' => $equipe_id]);
         }
      }

      //l'ajout des types assurance user
      if(!empty($request->types_assurance)) {
         foreach($request->types_assurance as $type_id) {
            User_type_assurance::create(['user_id' => $user->id, 'type_assurance_id' => $type_id]);
         }
      }

      if(!empty($request->password)) {
         //$password = Hash::make($request->password);
         $request->merge(array('password' => Hash::make($request->password)));
         $user->update($request->all());
      } else {
         $user->update($request->except('password'));
      }


      /*$user_equipe = User_equipe::where('user_id', '=', $request->user_id)
         ->where('equipe_id', '=', $request->old_equipe_id)
         ->first();
      $user_equipe->update(['user_id' => $request->id, 'equipe_id' => $request->equipe_id]);*/
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('/equipe/' . $request->old_equipe_id . '/users');
      //return redirect()->back();
   }

   public function getStatistique(Request $request, $provenanceId = null) {
      $data = array();
      $user = User::findOrFail(Auth::user()->id);
      $usersIds = $user->getUsersEquipeByUser($user->id);

      $fichesMauvaiseEtats = Fiche_etat::where('etat_groupe_id', '=', 3)->pluck('id');

      //fiches  ========================================
      //fiches net
      $fichesIds = Fiche::query();
      $fichesIds = $fichesIds->whereIn('user_id', $usersIds);
      if(isset($provenanceId)) {
         $fichesIds = $fichesIds->where('provenance_id', ' = ', $provenanceId);
      }
      if($request != null && $request->date_debut != "" && $request->date_fin != "") {
         $date_debut = date("Y-m-d", strtotime(str_replace('/', '-', $request->date_debut)));
         $date_fin = date("Y-m-d", strtotime(str_replace('/', '-', $request->date_fin)));
         $fichesIds = $fichesIds->whereBetween('created_at', [$date_debut . " 00:00:00", $date_fin . " 23:59:59"]);
         $fichesIds = $fichesIds->where('created_at', '>=', $date_debut . " 00:00:00")
            ->where('created_at', '<=', $date_fin . " 23:59:59");
      }
      $fichesIds = $fichesIds->pluck('id');
      $countFiches = sizeof($fichesIds);
      $data['countFiches'] = $countFiches;
      //fiches mauvais
      $fichesMauvaiseIds = Fiche::query();
      $fichesMauvaiseIds = $fichesMauvaiseIds->whereIn('etat_id', $fichesMauvaiseEtats);
      $fichesMauvaiseIds = $fichesMauvaiseIds->whereIn('user_id', $usersIds);

      if($request != null && $request->date_debut != "" && $request->date_fin != "") {
         $date_debut = date("Y-m-d", strtotime(str_replace('/', '-', $request->date_debut)));
         $date_fin = date("Y-m-d", strtotime(str_replace('/', '-', $request->date_fin)));
         $fichesIds = $fichesIds->whereBetween('created_at', [$date_debut . " 00:00:00", $date_fin . " 23:59:59"]);
         $fichesMauvaiseIds = $fichesMauvaiseIds->where('created_at', '>=', $date_debut . " 00:00:00")
            ->where('created_at', '<=', $date_fin . " 23:59:59");
      }
      if(isset($provenanceId)) {
         $fichesMauvaiseIds = $fichesMauvaiseIds->where('provenance_id', ' = ', $provenanceId);
      }
      $fichesMauvaiseIds = $fichesMauvaiseIds->pluck('id');
      $countFichesMauvaise = sizeof($fichesMauvaiseIds);
      $data['countFichesMauvaise'] = $countFichesMauvaise;


      //$simulationIds = Simulation::whereIn('fiche_id', $fichesIds)->pluck('id');
      //$simulationIds = [];
      //devis ========================================
      $devisChuteEtats = Fiche_etat::where('etat_groupe_id', ' = ', 9)->pluck('id');

      //devis total
      $devis = Devis::where('numero_contrat', '!=', '0')->get();
      $countDevis = sizeof($devis);
      $data['countDevis'] = $countDevis;

      //devis chute
      $devisChute = Devis::where('numero_contrat', '!=', '0')
         ->where('fiche_etat_id', '!=', '8')
         ->get();
      $countDevisChute = sizeof($devisChute);
      $data['countDevisChute'] = $countDevisChute;


      $chiffreAffaireDevis = 0;
      foreach($devis as $d) {
         $chiffreAffaireDevis += $d->cotisation;
      }

      $chiffreAffaireDevisChute = 0;
      foreach($devisChute as $d) {
         $chiffreAffaireDevisChute += $d->cotisation;
      }

      $data['chiffreAffaireDevisChute'] = $chiffreAffaireDevisChute;
      $data['chiffreAffaireDevis'] = $chiffreAffaireDevis;


      @$brute = 100 * $countDevis / $countFiches;


      @$net = 100 * ($countDevis - $countDevisChute) / ($countFiches - $countFichesMauvaise);
      $data['brute'] = $brute;
      $data['net'] = $net;
      return $data;


   }

   public function tableauBord(Request $request) {
      $historique = null;
      $data = $this->getStatistique($request);
      $user = User::find(Auth::user()->id);
      $provenancesData = array();
      $provenances = Provenance::all();
      foreach($provenances as $provenance) {
         array_push($provenancesData, array_merge(['nom' => $provenance->valeur], $this->getStatistique($request, $provenance->id)));
      }


      if($request != null && $request->date != "") {
         //dd($request->date);
         $historique = Historique::whereIn('user_id', $user->getUsersEquipeByUser(Auth::user()->id))
            ->where("created_at", 'like', '%' . $request->date . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10);
      } else {
         //dd(date("Y-m-d"));
         $historique = Historique::whereIn('user_id', $user->getUsersEquipeByUser(Auth::user()->id))
            ->where("created_at", 'like', '%' . date("Y-m-d") . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10);
      }


      //wher date
      return view('admin.tableau-bord', compact('historique', 'data', 'provenancesData'));
   }

   public function regimeIndex() {
      $regimes = Regime::all();
      return view('admin.regimes.liste-regimes', compact('regimes'));
   }

   public function nouveauRegimeForm() {
      return view('admin.regimes.nouveau-regime');
   }

   public function nouveauRegime(Request $request) {
      $this->validate($request, [
         'valeur' => 'required|string',
         'libelle' => 'required|string',
      ]);
      Regime::create($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('/regimes');
   }

   public function regimeDetailsForm($id) {
      $regime = Regime::findOrFail($id);
      return view('admin.regimes.details-regime', compact('regime'));
   }

   public function regimeDetails(Request $request, $id) {
      if($request->id != $id) {
         abort(404);
      }
      $regime = Regime::findOrFail($id);
      $this->validate($request, [
         'valeur' => 'required|string',
         'libelle' => 'required|string',
      ]);
      $regime->update($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('/regimes');
   }

   public function regimeSuppression($id) {
      $regime = Regime::findOrFail($id);

      if(sizeof($regime->personnes) > 0 || sizeof($regime->regimes_regles) > 0) {
         Session::flash('message', 'Vous ne pouvez pas supprimer ce élément !');
         Session::flash('alert-class', 'alert-warning');
      } else {
         $regime->delete();
         Session::flash('message', 'Votre demande a été bien traitée');
         Session::flash('alert-class', 'alert-success');
      }
      return redirect('/regimes');
   }

   public function voletsIndex() {
      $volets = Volet::all();
      return view('admin.volets.liste-volets', compact('volets'));
   }

   public function nouveauVoletForm() {
      return view('admin.volets.nouveau-volet');
   }

   public function nouveauVolet(Request $request) {
      $this->validate($request, [
         'valeur' => 'required|string',
         'description' => 'nullable|string'
      ]);
      Volet::create($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('/volets');
   }

   public function voletDetailsForm($id) {
      $volet = Volet::findOrFail($id);
      return view('admin.volets.details-volet', compact('volet'));
   }

   public function voletDetails(Request $request, $id) {
      $volet = Volet::findOrFail($id);
      if($request->id != $id) {
         abort(404);
      }

      $this->validate($request, [
         'valeur' => 'required|string',
         'description' => 'nullable|string'
      ]);
      $volet->update($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('/volets');
   }

   public function voletSuppression($id) {
      $volet = Volet::findOrFail($id);
      if(sizeof($volet->sousVolets) > 0) {
         Session::flash('message', 'Vous ne pouvez pas supprimer ce élément');
         Session::flash('alert-class', 'alert-warning');
      } else {
         $volet->delete();
         Session::flash('message', 'Votre demande a été bien traitée');
         Session::flash('alert-class', 'alert-success');
      }
      return redirect('/volets');
   }

   public function nouveauSousVoletForm($id) {
      $gammes = Gamme::all();
      $volet = Volet::findOrFail($id);
      return view('admin.sous-volets.nouveau-sous-volet', compact('volet', 'gammes'));
   }

   public function nouveauSousVolet(Request $request, $id) {
      if($id != $request->volet_id) {
         abort(403);
      }
      $this->validate($request, [
         'volet_id' => 'required|numeric',
         'valeur' => 'required|string|max:255',
         'description' => 'nullable|string',
         'gamme_id' => 'required|numeric',
      ]);
      Sous_volet::create($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('volet/' . $request->volet_id);
   }

   public function sousVoletDetailsForm($volet_id, $sous_volet_id) {
      $sous_volet = Sous_volet::findOrFail($sous_volet_id);
      if($sous_volet->volet->id != $volet_id) {
         abort(404);
      }
      $gammes = Gamme::all();
      $volets = Volet::all();
      return view('admin.sous-volets.details-sous-volet', compact('sous_volet', 'gammes', 'volets'));

   }

   public function sousVoletDetails(Request $request, $volet_id, $sous_volet_id) {
      if($request->id != $sous_volet_id) {
         abort(404);
      }
      $sous_volet = Sous_volet::findOrFail($sous_volet_id);
      $this->validate($request, [
         'volet_id' => 'required|numeric',
         'valeur' => 'required|string|max:255',
         'description' => 'nullable|string',
         'gamme_id' => 'required|numeric',
      ]);
      $sous_volet->update($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('volet/' . $request->volet_id . '/sous-volet/' . $request->id);
   }

   public function sousVoletSuppression($volet_id, $sous_volet_id) {
      $sous_volet = Sous_volet::findOrFail($sous_volet_id);
      if(sizeof($sous_volet->asterisques) > 0 || sizeof($sous_volet->valeurs) > 0) {
         Session::flash('message', 'Vous ne pouvez pas supprimer ce élément');
         Session::flash('alert-class', 'alert-warning');
      } else {
         $sous_volet->delete();
         Session::flash('message', 'Votre demande a été bien traitée');
         Session::flash('alert-class', 'alert-success');
      }
      return redirect('/volet/' . $volet_id);
   }

   public function groupesEtatsIndex() {
      $groupes_etats = Etat_groupe::all();
      return view('admin.groupes-etats.liste-groupes-etats', compact('groupes_etats'));
   }

   public function nouveauGroupeEtatsForm() {
      $roles = Role::all();
      return view('admin.groupes-etats.nouveau-groupe', compact('roles'));
   }

   public function nouveauGroupeEtats(Request $request) {
      $this->validate($request, [
         'valeur' => 'required|string',
         'libelle' => 'required|string'
      ]);

      try {
         DB::beginTransaction();
         $groupeId = Etat_groupe::create($request->all())->id;
         if(is_array($request->roles)) {
            foreach($request->roles as $role) {
               Groupe_etat_role::create(['role_id' => $role, 'etat_groupe_id' => $groupeId]);
            }
         }
         Session::flash('message', 'Votre demande a été bien traitée');
         Session::flash('alert-class', 'alert-success');
         DB::commit();
      } catch(\Exception $e) {
         Session::flash('message', $e->getMessage());
         Session::flash('alert-class', 'alert-warning');
      }

      return redirect('/groupes-etats');
   }

   public function groupeEtatsDetailsForm($id) {
      $roles = Role::all();
      $groupe_etats_roles = Groupe_etat_role::where('etat_groupe_id', $id)->get()->pluck('role_id')->toArray();
      $groupe_etats = Etat_groupe::findOrFail($id);
      return view('admin.groupes-etats.details-groupe-etats', compact('groupe_etats_roles', 'roles', 'groupe_etats'));
   }

   public function groupeEtatsDetails(Request $request, $id) {
      $groupe_etats = Etat_groupe::findOrFail($id);
      if($request->id != $id) {
         abort(404);
      }
      $this->validate($request, [
         'valeur' => 'required|string',
         'libelle' => 'required|string'
      ]);
      try {
         DB::beginTransaction();
         $groupe_etats->update($request->all());

         Groupe_etat_role::where('etat_groupe_id', '=', $id)->forcedelete();
         if(is_array($request->roles)) {
            foreach($request->roles as $role) {
               Groupe_etat_role::create(['role_id' => $role, 'etat_groupe_id' => $id]);
            }
         }
         Session::flash('message', 'Votre demande a été bien traitée');
         Session::flash('alert-class', 'alert-success');
         DB::commit();
      } catch(\Exception $e) {
         Session::flash('message', $e->getMessage());
         Session::flash('alert-class', 'alert-warning');
      }
      return redirect('/groupes-etats');
   }

   public function groupeEtatsSuppression($id) {
      $groupe_etats = Etat_groupe::findOrFail($id);
      if(sizeof($groupe_etats->fiche_etats) > 0 || sizeof($groupe_etats->groupe_etat_roles) > 0) {
         Session::flash('message', 'Vous ne pouvez pas supprimer ce élément');
         Session::flash('alert-class', 'alert-warning');
      } else {
         $groupe_etats->delete();
         Session::flash('message', 'Votre demande a été bien traitée');
         Session::flash('alert-class', 'alert-success');
      }
      return redirect('/groupes-etats');
   }

   public function nouveauEtatForm($id) {
      $groupe_etats = Etat_groupe::findOrFail($id);
      return view('admin.fiche-etats.nouveau-etat-fiche', compact('groupe_etats'));
   }

   public function nouveauEtat(Request $request, $id) {
      if($id != $request->etat_groupe_id) {
         abort(403);
      }
      $this->validate($request, [
         'etat_groupe_id' => 'required|numeric',
         'valeur' => 'required|string|max:255',
         'libelle' => 'nullable|string',
      ]);
      Fiche_etat::create($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('groupe-etats/' . $request->etat_groupe_id);
   }

   public function etatDetailsForm($etat_groupe_id, $etat_id) {
      $etat = Fiche_etat::findOrFail($etat_id);
      if($etat->groupe_etat->id != $etat_groupe_id) {
         abort(404);
      }
      $groupes_etats = Etat_groupe::all();
      return view('admin.fiche-etats.details-fiche-etat', compact('groupes_etats', 'etat'));
   }

   public function etatDetails(Request $request, $etat_groupe_id, $etat_id) {
      if($request->id != $etat_id) {
         abort(404);
      }
      $etat = Fiche_etat::findOrFail($etat_id);
      $this->validate($request, [
         'etat_groupe_id' => 'required|numeric',
         'valeur' => 'required|string|max:255',
         'libelle' => 'nullable|string',
      ]);
      $etat->update($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('groupe-etats/' . $request->etat_groupe_id . '/etat/' . $request->id);
   }

   public function etatSuppression($etat_groupe_id, $etat_id) {
      $etat = Fiche_etat::findOrFail($etat_id);
      if(sizeof($etat->fiches) > 0 || sizeof($etat->devis) > 0) {
         Session::flash('message', 'Vous ne pouvez pas supprimer ce élément');
         Session::flash('alert-class', 'alert-warning');
      } else {
         $etat->delete();
         Session::flash('message', 'Votre demande a été bien traitée');
         Session::flash('alert-class', 'alert-success');
      }
      return redirect('/groupe-etats/' . $etat_groupe_id);
   }

   /*public function nouvellePieceJointeForm($type, $id) {
      return view('admin.pieces-jointes.nouvelle-piece-jointe', compact('type', 'id'));
   }*/

   public function nouvellePieceJointe(Request $request) {
      $attributes = $request->all();
      $type = $request->type;
      $type_id = $request->type_id;
      $this->validate($request, [
         'type_id' => 'required|numeric',
         'fichier_description' => 'nullable|string',
         'fichier' => 'required|max:10000',
      ]);

      if($request->hasFile('fichier')) {
         $file = $request->file('fichier');
         $fileName = time() . '-' . $file->getClientOriginalName();
         $destinationPath = public_path('/uploads/pieces-jointes/' . $type . 's/' . $type_id);
         $file->move($destinationPath, $fileName);
         $attributes['url'] = $fileName;
      } else {
         $attributes['url'] = "";
      }
      $attributes['description'] = $request->fichier_description;
      $attributes[$type . '_id'] = $type_id;
      Piece_jointe::create($attributes);
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect()->back();
   }


   public function detailsPieceJointeForm($type, $type_id, $piece_id) {
      $piece = Piece_jointe::findOrFail($piece_id);
      return $this->sendResponse($piece, '');
   }

   public function detailsPieceJointe(Request $request, $type, $type_id, $piece_id) {
      $piece = Piece_jointe::findOrFail($piece_id);
      $attributes = $request->all();
      $type = $request->type;
      $type_id = $request->type_id;
      $validator = Validator::make($request->all(), [
         'type_id' => 'required|numeric',
         'fichier_description' => 'nullable|string',
         'fichier' => 'nullable|max:10000',
      ]);
      if($validator->fails()) {
         Session::flash('error_modif', true);
         Session::flash('piece', $piece);
         return redirect()->back()->withInput()->withErrors($validator);
      }
      if($request->hasFile('fichier')) {
         $file = $request->file('fichier');
         $fileName = time() . '-' . $file->getClientOriginalName();
         $destinationPath = public_path('/uploads/pieces-jointes/' . $type . 's');
         $file->move($destinationPath, $fileName);
         $attributes['url'] = $fileName;
      }
      $attributes[$type . '_id'] = $type_id;
      $attributes['description'] = $request->fichier_description;

      $piece->update($attributes);
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect()->back();
   }

   public function pieceJointeSuppression($type, $type_id, $piece_id) {
      $piece = Piece_jointe::findOrFail($piece_id);
      $piece->delete();
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect()->back();
   }

   public
   function templatesIndex() {
      $templates = Template::all();
      return view('admin.templates.liste-templates', compact('templates'));
   }

   public
   function nouvelleTemplateForm() {
      $template_types = Template_type::all();
      return view('admin.templates.nouvelle-template', compact('template_types'));
   }

   public
   function nouvelleTemplate(Request $request) {
      $this->validate($request, [
         'nom' => 'required',
         'type_id' => 'required',
         'template' => 'required|string|min:50',
      ]);
      Template::create($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('/templates');
   }

   public
   function detailsTemplateForm($id) {
      $template_types = Template_type::all();
      $template = Template::findOrFail($id);
      return view('admin.templates.details-template', compact('template', 'template_types'));
   }

   public
   function detailsTemplate(Request $request, $id) {
      if($request->id != $id) {
         abort(403);
      }
      $this->validate($request, [
         'nom' => 'required',
         'type_id' => 'required',
         'template' => 'required|string|min:50',
      ]);
      $template = Template::findOrFail($id);
      $template->update($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('/templates/' . $request->id);
   }


   public
   function templateSuppression($id) {
      $template = Template::findOrFail($id);
      $template->delete();
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('/templates');
   }

   //gestion zones
   public function gammeNouvelleZoneForm($compagnie_id, $gamme_id) {
      $compagnie = Compagnie::findOrFail($compagnie_id);
      $gamme = Gamme::findOrFail($gamme_id);
      return view('admin.zones.nouvelle-zone', compact('compagnie', 'gamme'));
   }

   public function gammeNouvelleZone(Request $request) {
      $this->validate($request, [
         'nom' => 'required'
      ]);
      Zone::create(['zone' => $request->nom, 'gamme_id' => $request->gamme_id]);
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('/compagnie/' . $request->compagnie_id . '/gamme/' . $request->gamme_id);
   }

   //gestion des adresses ip's
   public function adressesIndex() {
      $adresses = Ip_adresse::all();
      return view('admin.ip_adresses.liste-adresses', compact("adresses"));
   }


   public function nouvelleAdresseIpForm() {
      return view('admin.ip_adresses.nouvelle-ip-adresse');
   }

   public function nouvelleAdresseIp(Request $request) {
      $this->validate($request, [
         'adresse_ip' => 'required|ip'
      ]);
      Ip_adresse::create(array_merge($request->all(), ['user_id' => Auth::user()->id]));
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect('/adresses-ip/');
   }

   public function modificationAdresseIpForm($id) {
      $adresse = Ip_adresse::findOrFail($id);
      return view('admin.ip_adresses.details-ip-adresse', compact('adresse'));
   }

   public function modificationAdresseIp(Request $request, $id) {
      $this->validate($request, [
         'adresse_ip' => 'required|ip'
      ]);
      $adresse = Ip_adresse::findOrFail($id);
      $adresse->update(array_merge($request->all(), ['user_id' => Auth::user()->id]));
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect()->back();
   }

   public function suppressionAdresseIp($id) {
      $adresse = Ip_adresse::findOrFail($id);
      $adresse->delete();
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect()->back();
   }


   //formules gestion
   public function gammeNouvelleFormule(Request $request) {
      $this->validate($request, [
         'nom' => 'required',
         'gamme_id' => 'required',
      ]);
      Formule::create($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect()->back();
   }

   public function gammeGetFormuleData($compagnie_id, $gamme_id, $formule_id) {
      $formule = Formule::findOrFail($formule_id);
      return $this->sendResponse($formule, '');
   }


   public function gammeUpdateFormule(Request $request, $compagnie_id, $gamme_id, $formule_id) {
      $this->validate($request, [
         'nom' => 'required',
         'gamme_id' => 'required',
      ]);
      $formule = Formule::findOrFail($formule_id);
      $formule->update($request->all());
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect()->back();
   }

   public function gammeSuppressionFormule($compagnie_id, $gamme_id, $formule_id) {
      $formule = Formule::findOrFail($formule_id);
      $formule->delete();
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      return redirect()->back();
   }
}
