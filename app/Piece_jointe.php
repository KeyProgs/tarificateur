<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Piece_jointe extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'formule_id', 'gamme_id', 'compagnie_id', 'fiche_id', 'devis_id','email_id','message_id', 'url', 'description','type_id'
   ];
   protected $dates = [
      'created_at', 'updated_at', 'deleted_at'
   ];

   public function type() {
      return $this->hasOne('App\Piece_jointe_type', 'id', 'type_id');
   }
   //
}
