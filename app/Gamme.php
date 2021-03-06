<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Gamme extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id', 'nom', 'description', 'compagnie_id', 'type_assurance_id', 'e_age', 'e_age2', 'annee', 'date_prelevement', 'min_age', 'max_age'
    ];
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];

    public function compagnie()
    {
        return $this->belongsTo('App\Compagnie', 'compagnie_id', 'id');
    }

    public function formules()
    {
        return $this->hasMany('App\Formule', 'gamme_id', 'id');
    }

    public function type_assurance()
    {
        return $this->hasOne('App\Type_assurance', 'id', 'type_assurance_id');
    }

    public function TchequeAge($age)
    {
        if (is_array($age)) {
            foreach ($age as $age_) {
                if ($age_ < $this->min_age and $this->e_age == 0) {
                    return false;
                }
            }
        } else {
            if ($age < $this->min_age and $this->e_age == 0) {
                return false;
            }
        }
        return true;
    }

    public function TchequeCas($age)
    {
        return 1;
    }

    public function compagnies($gammesIds)
    {
        $idsString = "";
        foreach ($gammesIds as $gammeId) {
            $idsString .= $gammeId . ",";
        }
        $idsString = rtrim($idsString, ",");
        //dd('select distinct g.compagnie_id, c.nom from gammes g , compagnies c where g.compagnie_id = c.id and g.id IN (' . $idsString . ') and c.deleted_at != NULL');
        return DB::select('select distinct g.compagnie_id, c.nom from gammes g , compagnies c where g.compagnie_id = c.id and g.id IN (' . $idsString . ') and c.deleted_at IS NULL');
    }


    public function piece_jointes()
    {
        return $this->hasMany('App\Piece_jointe', 'gamme_id', 'id');
    }

    public function zones()
    {
        return $this->hasMany('App\Zone', 'gamme_id', 'id');
    }

    public function options()
    {
        return $this->hasMany('App\Option', 'gamme_id', 'id');
    }

    /*
      $data = [
                 'nbEnfants' => 0,
                 'AgeEnfant' => null,
                 'formule_id' => $formule_id,
                 'departement_id' => $departement_id,
                 'regime_idP' => null,
                 'regime_idC' => null,
                 'conjoint' => false,
                 'cotisation' => 0,
                 'valide' => false,
                 'message' => false,

             ];
     */

    public function validate3($data, $key = null)
    {
        if ($key != null)  return 1;

        $message = 'Validation Gamme 3 Formule(' . $data['formule_id'] . ') Regime(' . $data['regime_idP'] . ') ... ';

        $Personnes = $data['Personnes'];
        foreach ($Personnes as $personne) {
            $Prix = $personne['prix'];
            $message .= $personne['prix'] . " - " . $personne['zone_id'] . " - " . $personne['agee'] . "//";
            $reduction = 1;
            if ($personne['regime_id'] == 1) { //Alsace Mosel
                $message .= " Alsace Miosel";
                if ($data['formule_id'] == 6 || $data['formule_id'] == 8) { //initial 1 2
                    $message .= ' Reduction regime ini1&2 40% ';
                    $reduction = 40;
                }
                if ($data['formule_id'] == 9 || $data['formule_id'] == 10) {//initial 3 4
                    $message .= ' Reduction regime ini3&4 30% ';
                    $reduction = 30;
                }
                if ($data['formule_id'] == 11 || $data['formule_id'] == 18) { //initial 5 6
                    $message .= ' Reduction regime ini5&6 20% ';
                    $reduction = 20;
                }


            } elseif (
                $data['regime_idP'] == 4 //Exploitant Agricole
                || $data['regime_idP'] == 11 //TNS ind??pendant
                || $data['regime_idP'] == 7 //Retrait?? TNS
            ) { // TNS  & ExplAgric
                $message .= ' Reduction TNS 10% ';
                $reduction = 10;
            }


            //Calcule R??duction Regimes
            if ($reduction != 1) {
                $reduction = ($reduction * $Prix / 100);
                $message .= " Reduction($Prix - $reduction) ";
                $Prix = $Prix - $reduction;
            }
            $personne['prix'] = $Prix;
            $personne['message'] = "reduction (-$reduction ???/mois) ";

            $personne['reduction'] = $reduction;
            $personne['prixS'] = $personne['prix'] - ($personne['prix'] * $reduction / 100);
            $reduction = 1;
        }
        $message .= ' // Finn Test IDREGIME. ';


        $PrixFinale = 0;
        foreach ($Personnes as $personne) {
            $PrixFinale += $personne['prix'];
        }
        //dd($Personnes);
        $$reduction = 1;
        if ($data['nbEnfants'] > 0 and $data['conjoint'] == true) {
            $message .= ' Reduction Famille 10% ';
            $data['reduction_famille'] = 1;
            $reduction = 10;
        } elseif ($data['conjoint'] == true) {
            $message .= ' Reduction Conjoint 7% ';
            $data['reduction_couple'] = 1;
            $data['message'] = ' Reduction Conjoint 7% ';
            $reduction = 7;
        }
        if ($reduction != 1) $PrixFinale = $PrixFinale - ($reduction * $PrixFinale / 100);
        $data['cotisation'] = $PrixFinale;
        $data['cotisation'] = $PrixFinale + 2.5; //Frais Dossier
        $data['Frais_Dossier'] = 2.5;


        $data['message'] = $message;
        return $data;
    }

    public function validate28($data, $key = null)
    { if ($key != null)  return 1;
        return $data;
    }

    public function validate29($data, $key = null)
    { if ($key != null)  return 1;
        return $data;
    }

    public function validate6($data, $key = null)
    {
        if ($key != null)  return 1;


        $message = 'Validation Gamme 3 Formule(' . $data['formule_id'] . ') Regime(' . $data['regime_idP'] . ') ... ';

        $Personnes = $data['Personnes'];
        foreach ($Personnes as $personne) {
            $Prix = $personne['prix'];
            $message .= $personne['prix'] . " - " . $personne['zone_id'] . " - " . $personne['agee'] . "//";
            $reduction = 1;
            if ($personne['regime_id'] == 1) { //Alsace Mosel
                $message .= " Alsace Miosel";
                if ($data['formule_id'] == 6 || $data['formule_id'] == 8) { //initial 1 2
                    $message .= ' Reduction regime ini1&2 40% ';
                    $reduction = 40;
                }
                if ($data['formule_id'] == 9 || $data['formule_id'] == 10) {//initial 3 4
                    $message .= ' Reduction regime ini3&4 30% ';
                    $reduction = 30;
                }
                if ($data['formule_id'] == 11 || $data['formule_id'] == 18) { //initial 5 6
                    $message .= ' Reduction regime ini5&6 20% ';
                    $reduction = 20;
                }


            } elseif (
                $data['regime_idP'] == 4 //Exploitant Agricole
                || $data['regime_idP'] == 11 //TNS ind??pendant
                || $data['regime_idP'] == 7 //Retrait?? TNS
            ) { // TNS  & ExplAgric
                $message .= ' Reduction TNS 10% ';
                $reduction = 10;
            }


            //Calcule R??duction Regimes
            if ($reduction != 1) {
                $reduction = ($reduction * $Prix / 100);
                $message .= " Reduction($Prix - $reduction) ";
                $Prix = $Prix - $reduction;
            }
            $personne['prix'] = $Prix;
            $personne['message'] = "reduction (-$reduction ???/mois) ";

            $personne['reduction'] = $reduction;
            $personne['prixS'] = $personne['prix'] - ($personne['prix'] * $reduction / 100);
            $reduction = 1;
        }
        $message .= ' // Finn Test IDREGIME. ';


        $PrixFinale = 0;
        foreach ($Personnes as $personne) {
            $PrixFinale += $personne['prix'];
        }
        //dd($Personnes);
        $$reduction = 1;
        if ($data['nbEnfants'] > 0 and $data['conjoint'] == true) {
            $message .= ' Reduction Famille 10% ';
            $data['reduction_famille'] = 1;
            $reduction = 10;
        } elseif ($data['conjoint'] == true) {
            $message .= ' Reduction Conjoint 7% ';
            $data['reduction_couple'] = 1;
            $data['message'] = ' Reduction Conjoint 7% ';
            $reduction = 7;
        }
        if ($reduction != 1) $PrixFinale = $PrixFinale - ($reduction * $PrixFinale / 100);
        $data['cotisation'] = $PrixFinale;
        $data['cotisation'] = $PrixFinale + 2.5; //Frais Dossier
        $data['Frais_Dossier'] = 2.5;


        $data['message'] = $message;
        return $data;
    }

    public function validateReg()
    {

    }

    public function validate4($data, $key = null)
    { if ($key != null)  return 1;
        return $data['cotisation'];

    }


    public function validate7($data, $key = null)
    { if ($key != null)  return 1;
        return $data['cotisation'];

    }

    public function validate21($data, $key = null)
    { if ($key != null)  return 1;
        return $data['cotisation'];

    }

    public function validate22($data, $key = null)
    { if ($key != null)  return 1;
        return $data['cotisation'];

    }

    public function validate30($data, $key = null)
    {
        if ($key != null) {
           //echo  "************** $key";
            switch ($key) {
                case 'a':
                    return "A";
                    break;
                case 'c':
                    return "AC";
                    break;
                default:
                    return "P";
                    break;
            }


        } else {//if ($data['ages'] != null)

            return $data;
        }


    }

}
