<?php

namespace App\Http\Controllers;

use App\Devis;
use App\Fiche;
use App\Formule;
use App\Personne;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ClientController extends GlobaleController {

   private $civilites;
   private $regimes;
   private $situation_familiales;
   private $provenances;

   public function __construct() {
      $this->middleware('auth.client', ['except' => ['loginForm', 'login', 'logout']]);;
      $this->civilites = $this->listeCivilites();
      $this->regimes = $this->listeRegimes();
      $this->situation_familiales = $this->listeSituationFamiliales();
      $this->provenances = $this->listeProvenances();
   }

   public function loginForm() {
      return view('welcome');
   }

   public function login(Request $request) {

      $this->validate($request, [
         'email' => 'required|string',
         'password' => 'required|string',
      ]);
      $personne = Personne::where('email', '=', $request->email)
         ->where('password', '=', md5($request->password . env('APP_KEY')))
         ->first();
      if($personne != null) {
         Session::put('client', $personne);
         return \redirect('/espace-client/accueil');
      } else {
         return Redirect::back()->withInput()->withErrors(array('email' => 'Ces identifiants ne correspondent pas à nos enregistrements'));
      }
   }

   public function logout() {
      Session::flush();
      return \redirect()->route('login.client');
   }

   public function clientDevisVerification($fiche_id, $formule_id) {
      $fiche = Fiche::findOrFail($fiche_id);
      $formule = Formule::findOrFail($formule_id);
      return view('client.devis-verification', compact('fiche', 'formule'));
   }

   public function accueil() {
      return view('client.accueil');
   }

   public function demandeForm() {
      $personne_id = Session::get('client')->id;

      $civilites = $this->civilites;
      $regimes = $this->regimes;
      $situation_familiales = $this->situation_familiales;
      $provenances = $this->provenances;

      $fiche = Fiche::where('personne_id', '=', $personne_id)
         ->first();
      if(is_null($fiche)) {
         abort(403);
      }
      return view('client.demande.demande', compact('fiche', 'civilites', 'regimes', 'situation_familiales', 'provenances'));
   }

   public function profileInfosForm() {
      $client = Personne::findOrFail(Session::get('client')->id);
      return view('client.details-client', compact('client'));
   }

   public function profileInfos(Request $request) {
      $personne = Personne::findOrfail($request->id);
      $this->validate($request, [
         'nom' => 'required|string|max:255',
         'prenom' => 'required|string|max:255',
         'email' => 'required|string|email|max:255|unique:personnes,id,' . $request->id,
         'password' => 'nullable|string|min:6|confirmed'
      ]);

      if(!empty($request->password)) {
         $request->merge(array('password' => md5($request->password . env('APP_KEY'))));
         $personne->update($request->all());
      } else {
         $personne->update($request->except('password'));
      }
      Session::flash('message', 'Votre demande a été bien traitée');
      Session::flash('alert-class', 'alert-success');
      Session::put('client', $personne);
      return redirect()->route('infos.client');
   }


   //liste devis client
   public function listeDevis() {
      $simulationIds = array();
      $personne_id = Session::get('client')->id;
      $fiche = Fiche::where('personne_id', '=', $personne_id)
         ->first();
      if(is_null($fiche->simulations)) {
         abort(403);
      }
      foreach($fiche->simulations as $simulation) {
         array_push($simulationIds, $simulation->id);
      }
      $liste_devis = Devis::whereIn('simulation_id', $simulationIds)->get();
      return view('client.devis.liste-devis', compact('liste_devis'));
   }
}
