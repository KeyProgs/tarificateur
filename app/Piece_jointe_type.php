<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Piece_jointe_type extends Model {
   use SoftDeletes;
   protected $fillable = [
      'id', 'type'
   ];
   protected $dates =[
      'deleted_at','updated_at','deleted_at'
   ];
}
