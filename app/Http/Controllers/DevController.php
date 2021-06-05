<?php

namespace App\Http\Controllers;

use App\Banque;
use App\Civilite;
use App\Compte;
use App\Details_personne;
use App\Fiche;
use App\Fiche_etat;
use App\Historique;
use App\Personne;
use App\Personne_personne;
use App\Provenance;
use App\Regime;
use App\Simulation;
use App\Situation_familiale;
use App\Type_assurance;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DevController extends Controller
{


    public function genererPermissionsFunctions()
    {
        $permissionsFunctions = array(
            'nouvelleFiche' => 'ajouter une fiche',
            'listeFichesFraiches' => 'liste des fiches fraiches',
            'modificationFiche' => 'modifier une fiche'
        );
        foreach ($permissionsFunctions as $key => $value) {

        }

    }

    public function Insert_csv($numero)
    {
        $handle = fopen("http://crm.acsassurance.com/db01.csv", "r");
        $Colonnes = null;
        $counter = 0;
        while (($line = fgets($handle)) !== false) {
            $line = utf8_encode($line);
            //$line = str_replace("Ž","é", $line);
            //$line = str_replace("ˆ","à", $line);
            //$line = str_replace("ï¿½","é", $line);
            $Colonnes = explode(";", $line);
            break;
        }
        $data = [
            'nomP' => 'Nom Prospect',
            'prenomP' => 'Prénoms Prospect',
            'dnP' => 'Date Naissance Prospect',
            'regimeP' => 'Régime Prospect',
            'nssP' => 'Numéro de sécurité social Prospect',
            'ageP' => 'Age',
            'activite' => 'Activite Prospect',
            'amailP' => 'Email Prospect',

            'nomC' => 'Nom Conjoint',
            'prenomC' => 'Prénoms Conjoint',
            'dnC' => 'Date Naissance Conjoint',
            'regimeC' => 'Nom Conjoint',
            'nssC' => 'Numéro de sécurité social Conjoint',
            'ageC' => 'Age',
            'activiteC' => 'Activite Conjoint',
            'emailC' => 'Email Conjoint',

            'nomE1' => 'Nom Enfant 1',
            'prenomE1' => 'Prénoms Enfant 1',
            'dnE1' => 'Date Naissance Enfant 1',
            'regimeE1' => 'Nom Enfant 1',
            'nssE1' => 'Nom Enfant 1',
            'ageE1' => 'Nom Enfant 1',

            'nomE2' => 'Nom Enfant 2',
            'prenomE2' => 'Prénoms Enfant 2',
            'dnE2' => 'Date Naissance Enfant 2',
            'regimeE2' => 'Nom Enfant 2',
            'nssE2' => 'Nom Enfant 2',
            'ageE2' => 'Nom Enfant 2',

            'nomE2' => 'Nom Enfant 2',
            'prenomE2' => 'Prénoms Enfant 2',
            'dnE2' => 'Date Naissance Enfant 2',
            'regimeE2' => 'Nom Enfant 2',
            'nssE2' => 'Nom Enfant 2',
            'ageE2' => 'Nom Enfant 2',


            'code_postal' => 'Code Postal',
            'ville' => 'Ville',
            'adresse' => 'Adresse',
            'email' => 'Email',
            'telephone_1'=>'telephone_1',
            'telephone_2'=>'telephone_2',
            'telephone_3'=>'telephone_3',

            'Note' => 'Note',
            'situation_familiale_id' => 'situation familiale',


        ];

        return view('includes/insert', compact('data', 'Colonnes'));

    }

    public function Insert_csv_action(Request $request)
    {
        //try {
            DB::beginTransaction();
            $handle = fopen("http://crm.acsassurance.com/db01.csv", "r");

            $Colonnes = null;
            $counter = -1;
        ini_set('max_execution_time', 9000);
            while (($line = fgets($handle)) !== false) {
                $counter++;
                $line = utf8_encode($line);
                if ($counter == 0) {
                    $line = utf8_encode($line);
                    //$line = str_replace("Ž","é", $line);
                    //$line = str_replace("ˆ","à", $line);
                    //$line = str_replace("ï¿½","é", $line);
                    //$Colonnes = explode(";", $line);
                } else{
                    $Colonnes = explode(";", $line);
                    $data = [
                        'NomP' => 'Nom Prospect',
                        'PrenomP' => 'Prénoms Prospect',
                        'DNP' => 'Date Naissance Prospect',
                        'RegimeP' => 'Régime Prospect',
                        'NssP' => 'Numéro de sécurité social Prospect',
                        'AgeP' => 'Age',
                        'Activite' => 'Activite Prospect',
                        'EmailP' => 'Email Prospect',

                        'nomC' => 'Nom Conjoint',
                        'PrenomC' => 'Prénoms Conjoint',
                        'DNC' => 'Date Naissance Conjoint',
                        'RegimeC' => 'Régime Conjoint',
                        'NssC' => 'Numéro de sécurité social Conjoint',
                        'AgeC' => 'Age',
                        'ActiviteC' => 'Activite Conjoint',
                        'EmailC' => 'Email Conjoint',

                        'nomE1' => 'Nom Enfant 1',
                        'PrenomE1' => 'Prénoms Enfant 1',
                        'DNE1' => 'Date Naissance Enfant 1',
                        'RegimeE1' => 'Régime Enfant 1',
                        'NssE1' => 'Nom Enfant 1',
                        'AgeE1' => 'Nom Enfant 1',

                        'nomE2' => 'Nom Enfant 2',
                        'PrenomE2' => 'Prénoms Enfant 2',
                        'DNE2' => 'Date Naissance Enfant 2',
                        'RegimeE2' => 'Régime Enfant 2',
                        'NssE2' => 'Nom Enfant 2',
                        'AgeE2' => 'Nom Enfant 2',

                        'nomE2' => 'Nom Enfant 2',
                        'PrenomE2' => 'Prénoms Enfant 2',
                        'DNE2' => 'Date Naissance Enfant 2',
                        'RegimeE2' => 'Régime Enfant 2',
                        'NssE2' => 'Nom Enfant 2',
                        'AgeE2' => 'Nom Enfant 2',


                        'CP' => 'Code Postal',
                        'Ville' => 'Ville',
                        'Adresse' => 'Adresse',
                        'Email' => 'Email',



                        'Note' => 'Note',
                        'situation_familiale_id' => 'situation familiale',


                    ];

                    $personne = [
                        'nom' => $Colonnes[$request->nomP],
                        'prenom' => $Colonnes[$request->prenomP],
                        'civilite_id' => null,
                        'date_naissance' => null,
                        'regime_id' => null,
                        'situation_familiale_id' => null,
                        'numero_securite_sociale' => null,
                        'numero_affiliation' => null,
                        'email' => @$Colonnes[$request->emailP],

                    ];
                    $personne=Personne::create($personne);
                    echo " ($counter) // personne($personne->id)  // ";
                    $details_personnes=[
                        'personne_id'=>$personne->id,
                        'numero_appartement_etage'=>null,
                        'avenue_rue'=>null,
                        'numero_appartement_etage'=>null,
                        'residence_immeuble_batiment'=>null,
                        'numero'=>null,
                        'adresse'=>@$Colonnes[$request->adresse],
                        'ville'=>@$Colonnes[$request->ville],
                        'ville_id'=>null,
                        'code_postal'=>@$Colonnes[$request->code_postal],
                        'telephone_1'=>@$Colonnes[$request->telephone_1],
                        'telephone_2'=>@$Colonnes[$request->telephone_2],
                        'telephone_3'=>@$Colonnes[$request->telephone_3],
                    ];
                   // dd($personne,$details_personnes);
                    $details_personnes=Details_personne::create($details_personnes);
                    echo " details_personnes($details_personnes->id)";


                    $fiche = [
                        'provenance_id' => 1,
                        'user_id' => 0,
                        'equipes_autorisees' => null,
                        'etat_id' => 1,
                        'personne_id' => $personne->id,
                        'date_effet' => null,
                        'date_rappel' => null,
                        'note' => 50,
                        'recommend' => null

                    ];
                    $fiche=Fiche::create($fiche);
                    echo " Fiche($fiche->id) ............ <br>";

                }
            }

            fclose($handle);
            DB::commit();
       /* } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }*/

    }

    public function insererleads($numero)
    {


        try {
            DB::beginTransaction();

////////////DEbut
            $handle = fopen("http://192.168.100.230/AssurPourTous.csv...", "r");
            //$adresse = "http://".$_SERVER['SERVER_NAME'];
            //echo $adresse;
            // exit;

            $counter = 0;
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    $counter++;

                    if ($counter == (3000 + $numero)) {
                        echo "<br><br>ACS : " . $counter . ' ::: () ';
                        $numero = $numero + $counter;
                        //DB::commit();
                        break;
                        //return redirect('insererleads/' . $numero);
                        //echo '<br>-----------------------redirected--------------------------.<br>';
                    } else {
                        echo "..::(acs: " . $counter . ')::..';
                    }
                    if ($counter >= $numero) {

                        $line = utf8_encode($line);
                        //$line = str_replace("Ž","é", $line);
                        //$line = str_replace("ˆ","à", $line);
                        //$line = str_replace("ï¿½","é", $line);

                        $line = explode(";", $line);


                        $Statut = $line[1];
                        $Sous_Statut = $line[2];
                        $Compagnie = $line[5];
                        $Date_Devenir_Client = $line[7];
                        $Date_Effet = $line[8];
                        $Num_Contrat = $line[9];
                        $Gamme = $line[10];
                        $Formule = $line[11];               //
                        $Montant = $line[12];               //
                        $Mode_de_paiement = $line[13];      //
                        $Provenance = $line[14];            //
                        $Commentaire = $line[16];           //
                        $Activite = $line[25];              //

                        //
                        $Conseiller = $line[15];            //OK
                        $Nom = $line[17];                   //OK
                        $Prenom = $line[18];                //OK
                        $Email = $line[19];                 //OK
                        $Tel1 = $line[20];                  //OK
                        $Tel2 = $line[21];                  //OK
                        $Tel3 = $line[22];                  //OK
                        $Civilite = $line[23];              //OK
                        $SituationMaritale = $line[24];     //OK
                        $Date_Naissance = $line[26];        //OK
                        if ($Date_Naissance != null) {
                            $date_array = explode("/", $Date_Naissance); // split the array
                            $var_day = $date_array[0]; //day seqment
                            $var_month = $date_array[1]; //month segment
                            $var_year = $date_array[2]; //year segment
                            $Date_Naissance = "$var_year/$var_month/$var_day"; // join them together
                        } else {
                            $Date_Naissance = '1900-01-01';
                        }


                        $Adresse_Postale = $line[27];       //OK
                        $CodePostal = $line[28];            //OK
                        $Ville = $line[29];                 //OK
                        $NumeroSS = $line[30];              //OK
                        $NumeroAffiliation = $line[31];     //OK
                        $Regime = $line[32];                //OK
                        $NB_Enfants = $line[33];            ////////
                        $Civilite_Conjoint = $line[34];     //OK
                        $Nom_Conjoint = $line[35];          //OK
                        $Prenom_Conjoint = $line[36];       // OK
                        $Date_Naissance_Conjoint = $line[37];//OK
                        if ($Date_Naissance_Conjoint != null) {
                            $date_array = explode("/", $Date_Naissance_Conjoint); // split the array
                            $var_day = $date_array[0]; //day seqment
                            $var_month = $date_array[1]; //month segment
                            $var_year = $date_array[2]; //year segment
                            $Date_Naissance_Conjoint = "$var_year/$var_month/$var_day"; // join them together
                        } else {
                            $Date_Naissance_Conjoint = '1900-01-01';
                        }


                        $Regime_Conjoint = $line[38];        //OK
                        $NumeroSS_Conjoint = $line[39];      //OK
                        $Activite_Conjoint = $line[41];     //OK
                        $DateRappel = $line[42];            // ok
                        $LettreResiliationOrganisme = $line[43];         //
                        $LettreResiliationMotif = $line[44];            //
                        $LettreResiliationDateEcheance = $line[45];     //
                        $LettreResiliationNumeroPolice = $line[46];     //
                        $LettreResiliationAdresse = $line[47];          //
                        $LettreResiliationCP = $line[48];               //
                        $LettreResiliationVille = $line[49];            //
                        $LettreResiliationPhone = $line[50];            //
                        $Qualif_Detail = $line[51];                     //
                        $TitulaireCompte_Nom = $line[52];               //
                        $TitulaireCompte_Prenom = $line[53];            //
                        $TitulaireCompte_Adresse = $line[54];           //
                        $TitulaireCompte_CodePostal = $line[55];        //
                        $TitulaireCompte_Ville = $line[56];             //
                        $Banque = $line[57];                            //
                        $BanqueAdresse = $line[58];            //
                        $BanqueCodePostal = $line[59];            //            //
                        $BanqueVille = $line[60];            //
                        $CodeIBAN = $line[61];            //
                        $CodeBIC = $line[62];            //
                        $Num_Lead = $line[63];            //
                        $Rank = $line[64];            //

//////////////////////////////////////////////////////////////////////////////////////Insertion Personne
                        $oCivilite = Civilite::where('valeur', '=', $Civilite)->first();
                        $civilite_id = 1;
                        if (@$oCivilite->id != null) {
                            $civilite_i1 = $oCivilite->id;
                        }
                        $oSituationMaritale = Situation_familiale::where('valeur', '=', $SituationMaritale)->first();
                        @$situation_familiale_id = $oSituationMaritale->id;


                        $oRegime = Regime::where('valeur', '=', $Regime)->first();
                        @$regime_id = $oRegime->id;

                        $Prospect = [
                            'nom' => $Nom,
                            'prenom' => $Prenom,
                            'civilite_id' => $civilite_id,
                            'date_naissance' => $Date_Naissance,
                            'regime_id' => $regime_id,
                            'situation_familiale_id' => $situation_familiale_id,
                            'activite' => $Civilite,
                            'numero_securite_sociale' => $NumeroSS,
                            'numero_affiliation' => $NumeroAffiliation,
                        ];
                        $personne_id = Personne::create($Prospect)->id;
                        // echo "$personne_id : Prospect created _ <b>";

//////////////////////////////////////////////////////////////////////////////////////Detail Personne
                        $Details_personne = [
                            'personne_id' => $personne_id,
                            'avenue_rue' => '',
                            'numero_appartement_etage' => '',
                            'residence_immeuble_batiment' => '',
                            'numero' => '',
                            'adresse' => $Adresse_Postale,
                            'ville' => $Ville,
                            'code_postal' => $CodePostal,
                            'email' => $Email,
                            'telephone_1' => $Tel1,
                            'telephone_2' => $Tel2,
                            'telephone_3' => $Tel3,
                        ];
                        $id_Details_personne = Details_personne::create($Details_personne)->id;
                        //echo "$id_Details_personne : id_Details_personne created  _ <b>";

//////////////////////////////////////////////////////////////////////////////////////Conjoint
                        $oCivilite_C = Civilite::where('valeur', '=', $Civilite_Conjoint)->first();
                        @$civilite_id_C = $oCivilite_C->id;

                        $oRegime_C = Regime::where('valeur', '=', $Regime_Conjoint)->first();
                        @$regime_id_C = $oRegime_C->id;

                        if ($Civilite_Conjoint != null or $Nom_Conjoint != null or $Prenom_Conjoint != null or $Date_Naissance_Conjoint != null) {
                            //insrtion conjoint

                            $Conjoint = [
                                'nom' => $Nom_Conjoint,
                                'prenom' => $Prenom_Conjoint,
                                'civilite_id' => $civilite_id_C,
                                'date_naissance' => $Date_Naissance_Conjoint,
                                'regime_id' => $regime_id_C,
                                'situation_familiale_id' => $situation_familiale_id,
                                'activite' => $Activite_Conjoint,
                                'numero_securite_sociale' => $NumeroSS_Conjoint,
                                'numero_affiliation' => '',

                            ];

                            $personne_concerne_id = Personne::create($Conjoint)->id;
                            echo "$personne_concerne_id : personne_concerne_id created  _ <b>";


                            // Insertion relation Conjoint Prospect
                            $Personne_personne_id = Personne_personne::create([
                                'personne_id' => $personne_id,
                                'personne_concerne_id' => $personne_concerne_id,
                                'type_relation' => 'conjoint'
                            ])->id;
                            echo "$Personne_personne_id Personne_personne_id created _ <b>";

                        }

//////////////////////////////////////////////////////////////////////////////////////Enfant
                        //insertion Enfant
                        for ($i = 0; $i <= $NB_Enfants; $i++) {
                            $Enfant = [
                                'nom' => '',
                                'prenom' => '',
                            ];
                            $id_Enfant = Personne::create($Enfant)->id;
                            Personne_personne::create([
                                'personne_id' => $personne_id,
                                'personne_concerne_id' => $id_Enfant,
                                'type_relation' => 'enfant'
                            ]);
                            //echo "$id_Enfant : id_Enfant created _ <b>";

                        }
/////////////////////////////////////////////////////////////////////////////////////Insertion Fiche
                        //Get User From Table By Name
                        $oProvenance = Provenance::where('valeur', '=', $Provenance)->first();
                        $Provenance_id = 1;
                        if (@$oProvenance->id != null) {
                            $Provenance_id = $oProvenance->id;
                        }


                        $oUser = User::where('nom', '=', $Conseiller)->first();
                        $id_user = 3;

                        if (@$oUser->id != null) {
                            $id_user = $oUser->id;
                        } else {
                            echo $Conseiller . " Introuvale . <b>";
                            exit;
                        }


                        $oStatut = Fiche_etat::where('valeur', '=', $Statut)->first();
                        $Etat_id = 1;
                        if (@$oStatut->id != null) {
                            $Etat_id = $oStatut->id;
                        } else {
                            echo $Statut . " Introuvale . <b>";
                            exit;
                        }


                        if ($DateRappel != null) {
                            $DateRappel = explode(" ", $DateRappel);
                            $date = explode("/", $DateRappel[0]);
                            $DateRappel = $date[2] . "-" . $date[1] . "-" . $date[0] . " " . $DateRappel[1];
                        } else {
                            $DateRappel = null;
                        }

                        $Fiche = [
                            'provenance_id' => $Provenance_id,
                            'user_id' => $id_user,
                            'etat_id' => $Etat_id,
                            'personne_id' => $personne_id,
                            'date_rappel' => $DateRappel
                        ];
                        $Fiche = Fiche::create($Fiche)->id;
                        echo "<br>    $Fiche fiche Crée    <br>";


                        $oBanque = Banque::where('nom', '=', $Banque)->first();
                        if (@$oBanque->id != null) {
                            $oBanqueID = $oBanque->id;
                        } else {
                            $oBanqueID = Banque::create(['nom' => $Banque, 'adresse' => null])->id;
                            echo $oBanqueID . " BANQUE inséré . <b>";
                            // exit;
                        }

                        $Compte = [
                            'personne_id' => $personne_id,
                            'fiche_id' => $Fiche,
                            'nom' => $Fiche,
                            'prenom' => $Fiche,
                            'adresse_tt' => $TitulaireCompte_Adresse,
                            'code_postal_tt' => $TitulaireCompte_CodePostal,
                            'numero_carte' => null,
                            'iban' => $CodeIBAN,
                            'bic' => $CodeBIC,
                            'adresse' => " $Banque / $BanqueAdresse / $BanqueCodePostal / $BanqueVille  ",
                            'ville_id' => null,
                            'banque_id' => $oBanqueID,
                        ];
                        $Compte = Compte::create($Compte)->id;


                        // }
/////////////////////////////////////////////////////////////////////////////////////Insertion Fiche
                        //inserer Un historique Commentaire More Info
                        $description = "Date_Devenir_Client : $Date_Devenir_Client <br> ";
                        $description = $description . "Statut : $Statut / $Sous_Statut  <br> ";
                        //$description = $description . "Date_Devenir_Client : $Date_Devenir_Client <br> ";
                        $description = $description . "Compagnie : $Compagnie <br> ";
                        $description = $description . "Date_Effet : $Date_Effet <br> ";
                        $description = $description . "Num_Contrat : $Num_Contrat <br> ";
                        $description = $description . "Gamme : $Gamme <br> ";
                        $description = $description . "Formule : $Formule  / $Montant <br>  ";
                        $description = $description . "Mode_de_paiement : $Mode_de_paiement <br> ";
                        $description = $description . "Activite : $Activite <br> ";
                        $description = $description . "LettreResiliationOrganisme : $LettreResiliationOrganisme <br> ";
                        $description = $description . "LettreResiliationMotif : $LettreResiliationMotif <br> ";
                        $description = $description . "LettreResiliationDateEcheance : $LettreResiliationDateEcheance <br> ";
                        $description = $description . "LettreResiliationNumeroPolice : $LettreResiliationNumeroPolice <br> ";
                        $description = $description . "LettreResiliationAdresse : $LettreResiliationAdresse <br> ";
                        $description = $description . "LettreResiliationCP : $LettreResiliationCP <br> ";
                        $description = $description . "LettreResiliationVille : $LettreResiliationVille <br> ";
                        $description = $description . "LettreResiliationPhone : $LettreResiliationPhone <br> ";
                        $description = $description . "Qualif_Detail : $Qualif_Detail <br> ";
                        $description = $description . "TitulaireCompte : $TitulaireCompte_Nom / $TitulaireCompte_Prenom <br> ";
                        $description = $description . "TitulaireCompte_Adresse : $TitulaireCompte_Adresse / $TitulaireCompte_CodePostal / $TitulaireCompte_Ville <br> ";
                        $description = $description . "Paiement : $Banque / $BanqueAdresse / $BanqueCodePostal / $BanqueVille  / $CodeIBAN-
                   - <br> ";

                        $description = $description . "Commentaire : $Commentaire  ($Conseiller)<br> ";
                        $description = str_replace("'", " ", $description);
                        //dd($description);
                        $Historique_id = Historique::create([
                            'user_id' => $id_user,
                            'fiche_id' => $Fiche,
                            'action_id' => 1,
                            'description' => ($description),
                            'vue' => 0
                        ])->id;

                        echo "$Historique_id Historique_id created <b><b><b> <---Fin fiche  (($Nom))... <br>";


                        // process the line read.


                        DB::commit();
                    }
                }
                echo "<br> FIN :(((" . $counter . ')))))<br>';

                fclose($handle);
            } else {
                echo "error opening the file.";
            }
///////FIN


            //DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }


        /*

        $data['id'] = "3";

        $user=  User::find(3);
        $var = $user->nom;
        //$user->nom="mhammed";

        //dd(get_defined_vars());
        return view('utilisateur.fiches.tarificateur', compact('data','user->nom'));

        //return "tarificateur";

        */

    }


    public function MonCompte()
    {
        return "MonCompte";

    }


}
