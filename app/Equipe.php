<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipe extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'valeur', 'libelle', 'description','agence','tel1','tel2','tel3','ville_id',
      'adresse1','adresse2','email','code_postal','local_server'
   ];

   protected $dates = [
      'deleted_at',
      'updated_at',
      'deleted_at'
   ];

   public function users() {
      $usersInEquipeIds = User_equipe::where('equipe_id', '=', $this->id)->pluck('user_id');
      $users = User::whereIn('id', $usersInEquipeIds)->get();
      return $users;
   }
   public function ville()
   {
      return $this->hasOne('App\Ville', 'id', 'ville_id');
   }
}
