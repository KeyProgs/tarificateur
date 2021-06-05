<?php

namespace App\Http\Controllers;


use App\Departement;
use App\Departement_zones;
use App\Fiche;
use App\Formule;
use App\Gamme;

use App\Prix_formule;
use App\Regime;
use App\Regime_regles;
use App\Regle;
use App\Sous_volet;
use App\Type_assurance;
use App\User_type_assurance;
use App\Ville;
use App\Volet;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TarificateurController extends GlobaleController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['Tarificateur', 'getZoneId', 'TchequeAge', 'sendResponse']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function tests()
    {
        $backup = Mail::getSwiftMailer();
        //Mail::send();
    }

    public function getZoneId($gamme_id, $department_id, $annee, $regime_id)
    {
        $zone = DB::table('zones')
            ->join('gammes', 'gammes.id', 'zones.gamme_id')
            ->join('departement_zones', 'departement_zones.zone_id', 'zones.id')
            ->join('regles', 'regles.zone_id', 'zones.id')
            ->join('regime_regles', 'regime_regles.regle_id', 'regles.id')
            ->where('regime_regles.regime_id', '=', $regime_id)
            ->where('regles.annee', '=', $annee)
            ->where('gammes.id', '=', $gamme_id)
            ->where('departement_zones.departement_id', '=', $department_id)
            ->select('zones.id')
            ->first();

        //dd($zone);

        //if($zone==null)return $this->sendResponse("ZONE Null $zone ($gamme_id, $department_id, $annee)", '');
        // if($zone->id ==null)dd($gamme_id, $department_id, $annee,$zone);
        if ($zone != null) return $zone->id;
        else return null;

    }

    public function Tarificateur($ficheId = null, $formule_id = null)
    {
        $PrixFormuleFiche = 0;
        $Cotisation = null;
        $fiche = Fiche::find($ficheId);
        $Formule = Formule::find($formule_id);
        //dd($formule_id);
        $formule_id = $formule_id;

        if ($fiche != null && $Formule != null) {
            // dd('ook');
            $Gamme = Gamme::findOrFail($Formule->gamme_id);
//            $departement_id = substr($fiche->personne->details->ville_id, -1, 2);
//            $cp = $fiche->personne->details->code_postal;
            $ville_id = $fiche->personne->details->ville_id;
            //$departement_id = $ville->getCodeDepFromCP($cp);
            //$departement_id = Departement::find(Ville::find($ville_id)->department_code)->id;
            $ville = Ville::find($ville_id);
            $departement = Departement::where('code', '=', ($ville->department_code))->first();
            $departement_id = $departement->id;

            if ($departement_id == null) {
                $t_message = "Departement ID Introuvable sur :($ville_id) ";
                return $this->sendResponse($t_message, "");
//                dd('Departement ID Introuvable sur :(' . $ville_id . ') ');
            }
//            $department_code = Ville::find($ville_id)->department_code;
//
            $regime_id = $fiche->personne->regime_id;
            //$Formule = new Formule();
            $validate = "validate" . $Gamme->id;
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
                'message' => "Data Message ! ",
                'Ptemp' => ''

            ];
            $ages['a'] = $fiche->personne;
            // $ages['p'] = $fiche->personne;
            $data['regime_idP'] = $fiche->personne->regime_id;
            if (!is_null($fiche->personne->conjoint())) {
                $ages['c'] = $fiche->personne->conjoint();
                $data['conjoint'] = true;
                $data['regime_idC'] = $fiche->personne->conjoint()->regime_id;
            }
            if (!empty($fiche->personne->enfants())) {
                foreach ($fiche->personne->enfants() as $Enfant) {
                    $ages[] = $Enfant;
                    $data['nbEnfants'] = sizeof($fiche->personne->enfants());
                }
            }
            //dd($Gamme->id, $departement_id,substr($fiche->date_effet,0,4));
            $zone_id = $this->getZoneId($Gamme->id, $departement_id, substr($fiche->date_effet, 0, 4), $regime_id);


            if ($zone_id != null) {

                if ($Gamme->TchequeAge($ages)) {
                    foreach ($ages as $key => $age) {
                        $Personne = $age;
                        $cas = $Gamme->$validate(null, $key);
                        //$age = Carbon::parse($age->date_naissance)->diff(\Carbon\Carbon::now())->format('%y');
                        //$age = Carbon::parse()->diff()->format('%y');
                        $age = substr($fiche->date_effet, 0, 4) - substr($age->date_naissance, 0, 4);


                        if ($Gamme->TchequeAge($age)) {

                            $agecalcule = $age;
                            //$zone_id = $this->getZoneId($Gamme->id, $departement_id);
                            //dd($zone_id);
                            $query = "select pf.prix from  prix_formules pf, regles r , regime_regles rr , formules f , zones z
                    where pf.regle_id=r.id 
                    and r.formule_id=f.id
                    and r.id=rr.regle_id
                    and r.zone_id=z.id
					and r.formule_id=$formule_id
                    and rr.regime_id=$Personne->regime_id
                    and z.id=$zone_id
                    and pf.age=$age 
                    and pf.cas='$cas'
                    and r.annee=YEAR('$fiche->date_effet')";
//and pf.cas=$cas
                            //dd($query);
                            $Prix = DB::select($query);

                            //dd($fiche->date_effet, $Personne->date_naissance ,$age,$Prix , $formule_id,$zone_id);
                            if (sizeof($Prix) > 0) {
                                //dd($Prix[0]->prix);
                                // dd( $data['cotisation'] , $Prix[0]->prix);
                                $data['cotisation'] = (double)$data['cotisation'] + (double)$Prix[0]->prix;
                                $data['Personnes'][$Personne->id] = $Personne;
                                $data['Personnes'][$Personne->id]['prix'] = (double)$Prix[0]->prix;
                                $data['Personnes'][$Personne->id]['zone_id'] = $zone_id;
                                $data['Personnes'][$Personne->id]['age'] = $age;
                            } else {
                                //dd($data);
                                if ($Gamme->e_age > 0 and $age < $Gamme->max_age) {
                                    $query = "select pf.prix from  prix_formules pf, regles r , regime_regles rr , formules f , zones z
                    where pf.regle_id=r.id 
                    and r.formule_id=f.id
                    and r.id=rr.regle_id
                    and r.zone_id=z.id
					and r.formule_id=$formule_id
                    and rr.regime_id=$Personne->regime_id
                    and z.id=$zone_id
                    and r.annee=YEAR('$fiche->date_effet')
                    and pf.cas='$cas' 
                    and pf.age=" . $Gamme->min_age;

                                    //dd($query);
                                    $Prix = DB::select($query);
                                    //dd($Prix);
                                    if (sizeof($Prix) > 0) {
                                        $data['Personnes'][$Personne->id] = $Personne;
                                        $data['Personnes'][$Personne->id]['prix'] = (double)$Prix[0]->prix;
                                        $data['cotisation'] = $data['cotisation'] + (double)$Prix[0]->prix;

                                        // echo "<br> age:" . Gamme::findOrFail(Formule::findOrFail($formule_id)->gamme_id)->min_age . " prix: " . (double)$Prix[0]->prix . '<br>';
                                    } else {
                                        //echo "prix introuvable pour age:$age formule: $formule_id Regime:$regime_id departement:$departement_id <br>";
                                        return $this->sendResponse("age($age) / zone_id($zone_id) / anneé(" . substr($fiche->date_effet, 0, 4) . ") ==> ", '');
                                    }

                                } else {
                                    return $this->sendResponse("age($age) / Regle($) / anneé(" . substr($fiche->date_effet, 0, 4) . ")", '');
                                }
                                //echo "prix  introuvable pour $age <br> ==> " . (double)$Prix[0]->prix;
                            }
                        } else {
                            return $this->sendResponse("$age ans: Non Elligible", '');

                        }
                    }
                    $data = $Gamme->$validate($data);
                }

            } else {
                return $this->sendResponse("CP:(" . $ville->zip_code . " " . $departement->name . ") Non géré ", "");
            }


            return $this->sendResponse(round(round($data['cotisation'], 3, PHP_ROUND_HALF_UP), 2), $data);
        } else {
            return $this->sendResponse('Err Fiche ou formule Introuvable', "");
        }


        //return

        //return $this->$validate
    }

    public function getPrices(Request $request, $formule_id = null, $ficheId = null)
    {


        if ($formule_id != null) {
            return $this->Tarificateur($ficheId, $formule_id);
            $request = null;
        } else
            return $this->Tarificateur($request['data']['IdFiche'], $request['data']['IdFormule']);
    }

    function GetGAmmePrices($gamme_id)
    {
        $Formules = Formule::where('gamme_id', '=', gamme_id)->get;
        foreach ($Formules as $formule) {
            $this->getPrices($formule->id);
        }
    }

    function regle($gamme_id, $zone_id = null, $annee = null)
    {
        //dd($gamme_id);
        $regle_id = null;
        $Gamme = Gamme::FindOrFail($gamme_id);
        if ($zone_id == null) {

            $zone = Zone::where('gamme_id', '=', $gamme_id)->get()[0];
            if ($zone == null) {
                $zone_id = Zone::create([
                    'gamme_id' => $gamme_id,
                    'zone' => $Gamme->nom . " Zone ?"
                ])->id;
            } else {
                $zone_id = $zone->id;
            }

        }

        $zone = Zone::find($zone_id);

        $regle = Regle::where('zone_id', '=', $zone_id)
            ->where('annee', '=', $annee)
            ->first();
        if (@sizeof($regle) > 0) {
            $regle_id = $regle->id;
        } else {
            if ($zone_id == null) dd("Regle Introuvable a l'année ($annee) pour la zone $zone_id "); //Ajout Regles

        }

        $Departements = Departement::all();
        $Regimes = Regime::all();

        //Departement_zones
        $Departement_zones = DB::table('departements')
            ->join('departement_zones', 'departement_zones.departement_id', '=', 'departements.id')
            ->whereNull('.departement_zones.deleted_at')
            ->where('.departement_zones.zone_id', '=', $zone_id)->get();

        //Regime_Regles

        $Regime_Regles = null;
        if ($regle_id != null)
            $Regime_Regles = DB::table('regimes')
                ->join('regime_regles', 'regime_regles.regime_id', '=', 'regimes.id')
                ->where('regime_regles.regle_id', '=', $regle_id)->get();
        // else dd("regle_id is null");

        $Formules = Formule::where('gamme_id', '=', $gamme_id)->get();

        $cas = 1;
        foreach ($Formules as $formule) {
            $prix_s = DB::table('prix_formules')
                ->join('regles', 'prix_formules.regle_id', '=', 'regles.id')
                ->join('zones', 'zones.id', '=', 'regles.zone_id')
                ->where('zones.id', $zone_id)
                ->where('regles.formule_id', $formule->id)
                ->where('regles.annee', @$annee)
                ->select('cas', 'prix', 'age', 'regles.id as  ', 'zones.id as zone_id')->get();;


            $idregles = @$prix_s[0]->idregles;
            //$zone_id = @$prix_s[0]->zone_id;
            if (!empty($prix_s)) {

                foreach ($prix_s as $prix_) {
                    $array[$prix_->age] = $prix_->prix;
                    $cas = $prix_->cas;
                }
            }
            $formule->prix = @$array;
            $formule->cas = $cas;

        }

        //dd( $formule->prix);


        return view('regles', compact('zone', 'zone_id', 'Gamme', 'zone_id', 'idregles', 'Departements', 'Regimes', 'Departement_zones', 'Formules', 'Regime_Regles','annee'));

    }

    function regles(Request $request)
    {
       //dd($request);
        //test TEXTAREA \r\n
        //$F6 = $request->F6;
        //$F6=explode("\r\n",$F6);
        //print_r($F6) ;
        //exit;

        //dd($request->Departement_regles);
        $Departement_zones = str_replace(" - ", "\r\n", $request->Departement_regles);
        $Departement_zones = str_replace(",", "\r\n", $Departement_zones);
        $Departement_zones = str_replace("-", "\r\n", $Departement_zones);
        $Departement_zones = str_replace("€", "\r\n", $Departement_zones);
        $Departement_zones = str_replace(" ", "", $Departement_zones);
        $Departement_zones = explode("\n", $Departement_zones);
        $Regime_regles = $request->Regime_regles;
        //dd($Regime_regles);

        //dd($Regime_regles);
        $FormulesIds[] = null;
        $gamme_id = $request->gamme_id;
        $ZoneName = $request->ZoneName;
        $Annee = $request->annee;
        //$Regle_Id = $request->idregles;
        //dd($request->all());


        $Gamme = Gamme::FindOrFail($gamme_id);
        //dd($Gamme);
        $FormulesIds = Formule::where('gamme_id', '=', $gamme_id)->pluck('id');
        //dd($FormulesIds);


        DB::beginTransaction();
        $zone_id = $request->zone_id;
        //dd($zone_id);
        $zone = Zone::find($zone_id);
        $zone_id = null;
        if ($zone != null) {
            $zone_id = $zone->id;
        } else {
            $zone_id = Zone::create(['gamme_id' => $gamme_id, 'zone' => $ZoneName])->id;
            echo "<br>    $zone_id zone_id created     <br>";
        }


        Departement_zones::where('zone_id', '=', $zone_id)->forcedelete();
        //$Departement_zones::where('zone_id' ,'=', $zone_id)->delete();
        echo "<br> === delete all Departement_zones in zone_id $zone_id ";
        foreach ($Departement_zones as $Departement_zone) {

            $Departement_zone = str_replace("\r", "", $Departement_zone);
            if (strlen($Departement_zone) == 1) {
                $Departement_zone = '0' . $Departement_zone;
            }
            $DepId = Departement::where('code', '=', $Departement_zone)->first();

            if ($DepId != null) {
                $DepId = $DepId->id;
                echo "<br> ======> zone_id($zone_id) ===== $Departement_zone trouver avec DepId($DepId)";
                Departement_zones::create(['zone_id' => $zone_id, 'departement_id' => $DepId]);

            } else {
                echo("ID Departement introuvable avec le code :" . $Departement_zone);
            }
        }


        //test Existance regles pour la zone avec la formule et l'anne

        foreach ($FormulesIds as $FormulesId) {
            $cas_formule_actuelle = 'OLD_CAS_F' . $FormulesId;
            $cas_formule_actuelle = $_POST[$cas_formule_actuelle];
            $cas_formule_new = 'CAS_F' . $FormulesId;
            $cas_formule_new = $_POST[$cas_formule_new];

            $Regle_Id = null;

            $Regle = Regle::where('formule_id', $FormulesId)
                ->where('annee', $Annee)
                ->where('zone_id', $zone_id)
                ->first();

            if ($Regle != null) {
                $Regle_Id = $Regle->id;
                echo " Une regle($Regle->id) pour formule($FormulesId)  Annee($Annee) existe deja";
            } else {
                $Regle_Id = Regle::create(['formule_id' => $FormulesId, 'annee' => $Annee, 'zone_id' => $zone_id])->id;
                echo " *Nouvelle Regle_Id($Regle_Id) sur  Zone($zone_id) avec  Année($Annee) <br>";
            }


            //Table Prix_Formule
            //1


            $InputRegle = 'F' . $FormulesId . "_A" . $Gamme->e_age;
            $Prix = $_POST[$InputRegle];
            //echo "<br>$InputRegle:  $Prix <br>";
            $Prix = str_replace(",", ".", $Prix);
            $Prix = str_replace("€NEANT", "", $Prix);
            $Prix = str_replace("NEANT", "", $Prix);
            $Prix = str_replace("€", "", $Prix);
            $Prix = str_replace(" ", "", $Prix);
            $Prix = str_replace("-", "", $Prix);
            if ($Prix == null) $Prix = 00.00;
            $Prix_formule = Prix_formule::where(['regle_id' => $Regle_Id, 'age' => $Gamme->e_age, 'cas' => $cas_formule_actuelle])->first();

            if ($Prix_formule != null) {
                echo "regle  ($Regle_Id) Trouvé Avec Formule : ($FormulesId)   => Prix $Prix sur id : $Prix_formule->id <bR>";
                $Prix_formule::where(['regle_id' => $Regle_Id, 'age' => $Gamme->e_age])->update(['prix' => $Prix, 'cas' => $cas_formule_new]);
                //$Prix_formule->prix = $Prix;
                //$Prix_formule->save();
                //echo "<br> Prix formule ID : " . $Prix_formule->id . " Valeur de prix Depuis Input " . $Prix . "<br>";
            } else {
                $IDPF = Prix_formule::create(['regle_id' => $Regle_Id, 'age' => $Gamme->e_age, 'prix' => (double)$Prix, 'cas' => $cas_formule_new])->id;
                echo "regle create : ($Regle_Id) Formule : ($FormulesId)   => Prix $Prix sur id : $IDPF <bR>";
            }


//2
            for ($Age = $Gamme->min_age; $Age <= $Gamme->max_age; $Age++) {
                $InputRegle = 'F' . $FormulesId . "_A" . $Age;
                //echo "<br>$InputRegle:  $request->$InputRegle <br>";
                $Prix = @$_POST[$InputRegle];
                $Prix = str_replace(",", ".", $Prix);
                $Prix = str_replace("€NEANT", "", $Prix);
                $Prix = str_replace("NEANT", "", $Prix);
                $Prix = str_replace("€", "", $Prix);
                $Prix = str_replace(" ", "", $Prix);
                $Prix = str_replace("-", "", $Prix);
                if ($Prix == null) $Prix = 00.00;


                //test Prix Existe
                $Prix_formule = Prix_formule::where(['regle_id' => $Regle_Id, 'age' => $Age, 'cas' => $cas_formule_actuelle])->first();

                if ($Prix_formule != null) {
                    echo "regle  ($Regle_Id) Trouvé Avec Formule : ($FormulesId)   => Prix $Prix sur id : $Prix_formule->id  ((($cas_formule_new)))<bR>";
                    $Prix_formule::where(['regle_id' => $Regle_Id, 'age' => $Age])->update(['prix' => $Prix, 'cas' => $cas_formule_new]);
                    //$Prix_formule->prix = $Prix;
                    //$Prix_formule->save();
                    //echo "<br> Prix formule ID : " . $Prix_formule->id . " Valeur de prix Depuis Input " . $Prix . "<br>";
                } else {
                    $IDPF = Prix_formule::create(['regle_id' => $Regle_Id, 'age' => $Age, 'prix' => (double)$Prix, 'cas' => $cas_formule_new])->id;
                    echo "regle createeed: ($Regle_Id) Formule : ($FormulesId)   => Prix $Prix sur id : $IDPF  ((($cas_formule_actuelle to $cas_formule_new)))<bR>";
                }

            }


            // exit;


            //Table Regime_regles
            Regime_regles::where('regle_id', '=', $Regle_Id)->delete();
            echo "<br> Regime_regles all delete $Regle_Id";
            foreach ($Regime_regles as $regime_regle) {
                //$DepId = Regime::where("libelle", "=", $regime_regle)->first()->id;
                Regime_regles::create(['regime_id' => $regime_regle, 'regle_id' => $Regle_Id]);
                echo "<br> Regime_regles Created : regime_id($regime_regle) Regle_Id ($Regle_Id) ";
            }


        }//


        DB::commit();
        try {
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        echo "FIN";
        exit;


    }

    public function MajAgePrix($Formule_id, $Gamme_id, $Regle_id)
    {
        dd("MajAgePrix");
        $InputRegle = 'F' . $Formule_id . "_A" . $Gamme_id;
        $Prix = $_POST[$InputRegle];
        $Prix = str_replace(",", ".", $Prix);
        $Prix = str_replace("€NEANT", "", $Prix);
        $Prix = str_replace("€", "", $Prix);
        $Prix = str_replace(" ", "", $Prix);
        $Prix = str_replace("-", "", $Prix);
        if ($Prix == null) $Prix = 00.00;
        $Prix_formule = Prix_formule::where(['regle_id' => $Regle_id, 'age' => $Gamme_id])->first();
        if ($Prix_formule != null) {
            echo "regle  ($Regle_id) Trouvé Avec Formule : ($Formule_id)   => Prix $Prix sur id : $Prix_formule->id <bR>";
            $Prix_formule::where(['regle_id' => $Regle_id, 'age' => $Gamme_id])->update(['prix' => $Prix]);
            //$Prix_formule->prix = $Prix;
            //$Prix_formule->save();
            //echo "<br> Prix formule ID : " . $Prix_formule->id . " Valeur de prix Depuis Input " . $Prix . "<br>";
        } else {
            $IDPF = Prix_formule::create(['regle_id' => $Regle_id, 'age' => $Gamme_id, 'prix' => (double)$Prix])->id;
            echo "regle : ($Regle_id) Formule : ($Formule_id)   => Prix $Prix sur id : $IDPF <bR>";
        }
    }

    public function getTarificateurFormules(Request $request, $IdsFormules = null)
    {
        $IdsFormules = explode(',', $IdsFormules);
        $garanties = null;

        $ArrayVolet = [];

        foreach ($IdsFormules as $IdFormule) {
            $garanties[$IdFormule]['garanties'] = null;
            $formule = Formule::find($IdFormule);
            $GR = DB::table('valeurs')->join('formules', 'formules.id', '=', 'valeurs.formule_id')
                ->join('sous_volets', 'sous_volets.id', '=', 'valeurs.sous_volet_id')
                ->where('formules.id', '=', $IdFormule)
                ->select('formules.id as id', 'formules.nom as NomFormule', 'valeurs.valeur as garantie', 'sous_volets.valeur as sous_volet', 'sous_volets.id as sous_volet_id')
                ->get();

            //dd($GR);
            foreach ($GR as $gr) {
                $garanties[$IdFormule]['garanties'][] = $gr;
            }
            $garanties['volets'] = [];
            $garanties[$IdFormule]['logo'] = $formule->gamme->logo;
            $garanties[$IdFormule]['IdFormule'] = $formule->id;
            $garanties[$IdFormule]['NomFormule'] = $formule->nom;
            $garanties[$IdFormule]['NomGamme'] = $formule->gamme->nom;
            $garanties[$IdFormule]['NomCompagnie'] = $formule->gamme->compagnie->nom;
            $garanties[$IdFormule]['prix'] = "";
            $volets = DB::table('volets')->select('volets.id', 'volets.valeur')->get();
            foreach ($volets as $volet) {
                $v = new Volet();
                $listeSousVolets = $v->getSousVoletsById($volet->id);
                if ($listeSousVolets !== NULL) {
                    $listeSousVolets['height'] = 0;
                    $ArrayVolet[$volet->valeur] = $listeSousVolets;
                }
                ///$ArrayVolet[$volet->valeur]['volet'] = $listeSousVolets;
            }

            $garanties['volets'] = $ArrayVolet;
            //dd($garanties);

            /*$volets = DB::table('volets')->select('volets.id', 'volets.valeur')->get();

           //liste sous volets ids
          $sousVoletsIds = DB::table('valeurs')->join('formules', 'formules.id', '=', 'valeurs.formule_id')
              ->join('sous_volets', 'sous_volets.id', '=', 'valeurs.sous_volet_id')
              ->where('formules.id', '=', $IdFormule)
              ->select('valeurs.sous_volet_id')
              ->get()->pluck('sous_volet_id')->toArray();

           foreach($volets as $volet) {
              $listeSousVolets = $this->getSousVoletsById($volet->id);
             if($listeSousVolets !== NULL) {
                 //$volet->liste_sous_volet = $listeSousVolets;
                 $ArrayVolet[$volet->id] = $listeSousVolets;
              }
           }

           $garanties[$IdFormule]['volets'] = $ArrayVolet;
           $garanties[$IdFormule]['logo'] = $formule->gamme->logo;
           $garanties[$IdFormule]['IdFormule'] = $formule->id;
           $garanties[$IdFormule]['NomFormule'] = $formule->nom;
           $garanties[$IdFormule]['NomGamme'] = $formule->gamme->nom;
           $garanties[$IdFormule]['NomCompagnie'] = $formule->gamme->compagnie->nom;
           $garanties[$IdFormule]['prix'] = "";*/


            //dd($ArrayVolet);
            /*$ArrayVolet;
            $volets;
            foreanch $volets as $volets
                 get $sousvlet
                 $ArrayVolet[$volets->id] = $sousvlet[];

            $garanties[$IdFormule]['volets'] = $ArrayVolet;*/
            /*$garanties[$IdFormule]['volets'] = DB::table('volets')->join('sous_volets', 'volets.id', '=', 'sous_volets.volet_id')
               ->join('valeurs', 'valeurs.sous_volet_id', '=', 'sous_volets.id')
               ->where('valeurs.formule_id', '=', $IdFormule)
               ->select('volets.id as volet_id', 'volets.valeur as volet_nom')
               ->get();

            $garanties[$IdFormule]['volets']['sous_volets'] = [];
            for($i = 0; $i < sizeof($garanties[$IdFormule]['volets']); $i++) {
               $sous_volet_data = DB::table('valeurs')->join('formules', 'formules.id', '=', 'valeurs.formule_id')
                  ->join('sous_volets', 'sous_volets.id', '=', 'valeurs.sous_volet_id')
                  ->where('formules.id', '=', $IdFormule)
                  ->where('sous_volets.volet_id', '=', $garanties[$IdFormule]['volets'][$i]->volet_id)
                  ->select('formules.id as id', 'formules.nom as NomFormule', 'valeurs.valeur as garantie', 'sous_volets.valeur as sous_volet', 'sous_volets.id as sous_volet_id')
                  ->get();
               var_dump($garanties[$IdFormule]['volets'][$i]);*/


            /*if($sous_volet_data!=null){
               $garanties[$IdFormule]['volets']['sous_volets'] = $sous_volet_data;
            }*/
            //echo 'volet index : ' . $i . ' value is : ' . $garanties[$IdFormule]['volets'][$i]->volet_id . "<br>";
            //echo 'formule id  ' . $IdFormule . '<br>';


            // }

            //old_code


            //$garanties[$IdFormule]->id = 'okk';

        }

        //dd($garanties);
        return $this->sendResponse($garanties, '');

        //dd($garanties);
        /*$dataFormules = array();
        if(!empty($request->data)) {

           $formulesIds = $request->data;
           $formulesIds = explode(',', $formulesIds);

           $formules = DB::table('formules')->
           whereIn('formules.id', $formulesIds)
              ->join('gammes', 'gammes.id', '=', 'formules.gamme_id')
              ->join('compagnies', 'compagnies.id', '=', 'gammes.compagnie_id')
              ->join('valeurs', 'valeurs.formule_id', '=', 'formules.id')
              ->select('valeurs.valeur as garantie', 'formules.id as id', 'formules.id as id', 'gammes.nom as NomGamme', 'formules.nom as NomFormule', 'compagnies.nom as NomCompagnie', 'compagnies.logo')
              ->get();


           /*foreach($formulesIds as $fId) {
              $formule = Formule::find($fId);
              //$formule->gamme_data = $formule->gamme;
              //$formule->compagnie_data = $formule->gamme->compagnie;
              //$formule->type_assurance_data = $formule->gamme->type_assurance;
              //$formule->prix = "";
              array_push($dataFormules, $formule);
           }*/
        /*return $this->sendResponse($garanties, '');
     }
     return null;*/
    }


    public function getTypeAssuranceFormules(Request $request)
    {
        $type_assurance_id = $request->type_assurance_id;
        $fiche_id = $request->fiche_id;
        $fiche = Fiche::find($fiche_id);
        $type_assurance = Type_assurance::find($type_assurance_id);
        $user_id = Auth::user()->id;
        $user_assurance_permissions = new User_type_assurance();
        $user_assurance_permissions->get_user_type_assurance();
        $user_types_assurance_array = $user_assurance_permissions->get_user_type_assurance();//array
        //$user_types_assurance = Auth::user()->user_type_assurance;
        $compagniesIds = [];
        $formulesIds = [];

        return view('includes.tarificateur.type-assurance-gamme-formule', compact('type_assurance', 'user_id', 'user_assurance_permissions', 'user_types_assurance_array', 'compagniesIds', 'fiche', 'formulesIds'));

    }

    public function valeurs($gamme_id)
    {
        $gameName = Gamme::where(['id' => $gamme_id])->first()->nom;
        $Formules = Formule::where('gamme_id', $gamme_id)->get();
        foreach ($Formules as $key => $formule) {
            $Formules[$key]->valeurs = DB::table('valeurs')->join('formules', 'formules.id', '=', 'valeurs.formule_id')
                ->where('formules.id', '=', $formule->id)
                ->select('valeur', 'valeurs.description', 'sous_volet_id')
                ->get();
            //dd($Formules[$key]->valeurs);
        }

        $Volets = Volet::all();
        $Valeurs = null;
        foreach ($Volets as $volet) {
            $Sous_volets = Sous_volet::where('volet_id', $volet->id)->get();
            $Valeurs["$volet->valeur"] = $Sous_volets;
        }


        return view('includes.tarificateur.valeurs', compact('Formules', 'Valeurs', 'gamme_id', 'gameName'));


    }

    public function updateValeurs(Request $request)
    {
        $Formules = Formule::where('gamme_id', $request->gamme_id)->get();
        $SousVolets = Sous_volet::all();
        foreach ($SousVolets as $sousVolet) {
            foreach ($Formules as $formule) {

                $valeur = "F" . $formule->id . "_SV" . $sousVolet->id;
                $valeur = $_POST[$valeur];
                $description = "DescF" . $formule->id . "_SV" . $sousVolet->id;
                $description = $_POST[$description];
                //echo "$valeur : F" . $formule->id . "_SV" . $sousVolet->id." : <br>";
                if (sizeof(DB::table('valeurs')
                        ->where('formule_id', $formule->id)
                        ->where('sous_volet_id', $sousVolet->id)->get()) > 0
                ) {
                    echo "Updated  <br>";
                    DB::table('valeurs')
                        ->where('formule_id', $formule->id)
                        ->where('sous_volet_id', $sousVolet->id)
                        ->update(['valeur' => $valeur, 'description' => $description]);

                } else {
                    echo "ADD <br>";
                    DB::table('valeurs')->insert(
                        ['formule_id' => $formule->id, 'sous_volet_id' => $sousVolet->id, 'valeur' => $valeur, 'description' => $description]
                    );
                }


            }
        }
        $this->valeurs($request->gamme_id);
    }


}
