<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model {
    use SoftDeletes;
    protected $fillable = [
        'id',
        'emetteur_id',
        'message',
        'objet',
        'recepteur_email'
    ];
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];


    public function piece_jointes() {
        return $this->hasMany('App\Piece_jointe', 'email_id', 'id');
    }
}
