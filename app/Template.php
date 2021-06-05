<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model {
   use SoftDeletes;
   protected $fillable = ['id', 'nom', 'type_id', 'template'];
   protected $dates = ['created_at', 'upadted_at', 'deleted_at'];

   public $Vars = array(
      "prospect" => array(
         "nom" => null,
         "prenom" => null,
         "regime" => null,
         "datenaissance" => null),
      "conjoint" => array(
         "conjoint_nom" => null,
         "conjoint_prenom" => null,
         "conjoint_regime" => null,
         "conjoint_datenaissance" => null),
      "details_fiche"=> array(
         "nb_enfants" =>null ,
         "date_effect" => null,
         "Tel1" => null,
         "Tel2" => null,
         "Tel3" => null,
         "email" => null,
         "adresse" => null,
         "ville" => null),
      "details_agent"=> array(
         "agent_nom" => null,
         "agent_prenom" => null,
         "agent_email" => null,
         "agent_telephone" => null,
         "agent_poste" => null,
        )
   );



   public function type() {
      return $this->hasOne('App\Template_type', 'id', 'type_id');
   }

}
