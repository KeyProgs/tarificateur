<?php

namespace App\Http\Controllers;

use App\Fiche;
use App\Helpers\Helper;
use App\Resiliation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ResiliationController extends GlobaleController {

   public function resiliationInfosForm($fiche_id) {
      $fiche = Fiche::findOrFail($fiche_id);
      return view('includes.tarificateur.resiliation-modal', compact('fiche'));
   }

   public function getAjaxResiliationInfos($id) {
      $resiliation = Resiliation::findOrFail($id);
      if($resiliation->ville_id != null) {
         $resiliation->ville_name = $resiliation->resil_ville->name;
      }
      if($resiliation->date_echeance != null) {
         $resiliation->date_echeance = Helper::getDateFormat($resiliation->date_echeance);
      }
      return $this->sendResponse($resiliation, '');
   }

   public function resiliationInfos(Request $request) {
      $modif = false;
      $nouveau_compte_id = null;
      $rules = [
         'organisme_resiliation' => 'required',
      ];
      $validator = Validator::make($request->all(), $rules);
      if($validator->fails()) {
         return response()->json(['errors' => $validator->errors()]);
      } else {
         $request->merge(["date_echeance_resiliation" => Helper::setDateFormat($request->date_echeance_resiliation)]);
         try {
            DB::beginTransaction();
            if($request->has('resiliation_id') && $request->resiliation_id != null) {
               $modif = true;
               //modification du resiliation
               $resiliation = Resiliation::findOrFail($request->resiliation_id);
               $resiliation->update(['organisme' => $request->organisme_resiliation, 'motif' => $request->motif_resiliation, 'date_echeance' => $request->date_echeance_resiliation, 'numero_police' => $request->numero_police_resiliation, 'adresse' => $request->adresse_resiliation, 'ville' => '', 'ville_id' => $request->ville_id_resiliation]);
            } else {
               //nouvelle resilation
               $nouveau_resiliation_id = Resiliation::create(['fiche_id' => $request->fiche_id, 'organisme' => $request->organisme_resiliation, 'motif' => $request->motif_resiliation, 'date_echeance' => $request->date_echeance_resiliation, 'numero_police' => $request->numero_police_resiliation, 'adresse' => $request->adresse_resiliation, 'ville' => '', 'ville_id' => $request->ville_id_resiliation])->id;
            }
            DB::commit();
            if($modif) {
               return $this->sendResponse('', 'Votre Modification a été bien traitée');
            } else {
               return $this->sendResponse(['id' => $nouveau_resiliation_id, 'organisme' => $request->organisme_resiliation], 'Votre demande a été bien traitée');
            }
         } catch(\Exception $e) {
            DB::rollback();
            return $this->sendError($e->getMessage());
         }
      }
   }
}
