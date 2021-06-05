<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regle extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id', 'formule_id', 'annee', 'zone_id'
    ];
    protected $dates = [
        'deleted_at', 'updated_at', 'deleted_at'
    ];

    public function zone()
    {
        return $this->belongsTo('App\Zone ', 'zone_id', 'id');
    }
    public function formule()
    {
        return $this->belongsTo('App\Formule', 'formule_id', 'id');
    }
}
