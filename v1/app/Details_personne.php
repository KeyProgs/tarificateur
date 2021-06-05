<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Details_personne extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'personne_id',
        'avenue_rue',
        'numero_appartement_etage',
        'residence_immeuble_batiment',
        'numero',
        'adresse',
        'ville',
        'ville_id',
        'code_postal',
        'email',
        'telephone_1',
        'telephone_2',
        'telephone_3'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function getEmailAttribute()
    {
        $personne = Personne::where('id', '=', $this->personne_id)->first();
        if ($personne != null) {
            return $personne->email;
        } else {
            return null;
        }
    }

    public function laville()
    {
        return $this->hasOne('App\Ville', 'id', 'ville_id');
    }

    function getVilleByCodePostal($code_postal)
    {
        $ville = '';
        $villes = Ville::where("zip_code", '=', $code_postal)->get();
        foreach ($villes as $v) {
            $ville .= '<option value=' . $v->id . '>'.$v->name.' ('.$v->zip_code.') </option>';
        }
        return $ville;
    }
}
