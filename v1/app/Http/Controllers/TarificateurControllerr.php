<?php

namespace App\Http\Controllers;

use App\Departement;
use App\Departement_regles;
use App\Formule;
use App\Gamme;
use App\Prix_formule;
use App\Regime;
use App\Regime_regles;
use App\Regle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarificateurController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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

    /**
     *
     */

    function regle($gamme_id, $regle_id = null)
    {

        $Gamme = Gamme::FindOrFail($gamme_id);
        $Departements = Departement::all();
        $Regimes = Regime::all();
        //  dd($Departement);
        $Departement_regles = Departement_regles::where('regle_id', '=', $regle_id);
        $Regime_regles = Regime_regles::where('regle_id', '=', $regle_id);


        $idregles = $regle_id;
        $Formules = Formule::where('gamme_id', '=', $gamme_id)->get();

        return view('regles', compact('Gamme', 'Formules', 'idregles', 'Departements', 'Departement_regles', 'Regimes', 'Regime_regles'));

    }


    function regles(Request $request)
    {

        //test TEXTAREA \r\n
        //$F6 = $request->F6;
        //$F6=explode("\r\n",$F6);
        //print_r($F6) ;
        //exit;

        $Modification=true;


        $Departement_regles = explode("\n", $request->Departement_regles);
        $Regime_regles = $request->Regime_regles;
        //
        //
        //
        //
        //dd($Regime_regles);
        $FormulesIds[] = null;
        $gamme_id = $request->gamme_id;
        $Annee = $request->annee;
        $Regle_Id = $request->idregles;
        //dd($request->all());


        $Gamme = Gamme::FindOrFail($gamme_id);
        //dd($Gamme);
        $FormulesIds = Formule::where('gamme_id', '=', 3)->pluck('id');
        //dd($FormulesIds);


        DB::beginTransaction();

        foreach ($FormulesIds as $FormulesId) {
            $Regle_Id = null;
            $Regle = Regle::where('formule_id', $FormulesId)->where('annee', $Annee)->first();

            if ($Regle != null) {
                $Regle_Id = $Regle->id;
                echo " Une regle pour formule_id " . $Regle->id . " existe deja";
            } else {

                $Regle_Id = Regle::create(['formule_id' => $FormulesId, 'annee' => $Annee])->id;
                //echo "Regle_Id : $Regle_Id (inserted) <br>";

            }


            //Table Prix_Formule
            for ($Age = $Gamme->min_age; $Age <= $Gamme->max_age; $Age++) {
                $InputRegle = 'F' . $FormulesId . "_A" . $Age;
                $Prix = $_POST[$InputRegle];
                $Prix = str_replace(",", ".", $Prix);

                //test Prix Existe
                $Prix_formule=Prix_formule::where(['regle_id' => $Regle_Id, 'age' => $Age]);
                if($Prix_formule != null){
                    $IDPF=$Prix_formule->id;
                    echo "regle  ($Regle_Id) Trouvé Avec Formule : ($FormulesId)   => Prix $Prix sur id : $IDPF <bR>";

                }else{
                    $IDPF = Prix_formule::create(['regle_id' => $Regle_Id, 'age' => $Age, 'prix' => $Prix])->id;
                    echo "regle : ($Regle_Id) Formule : ($FormulesId)   => Prix $Prix sur id : $IDPF <bR>";

                }


            }

            //Table Departement_regles
            // dd($Departement_regles);
            foreach ($Departement_regles as $departement_regle) {

                $departement_regle = str_replace("\r", "", $departement_regle);
                if (strlen($departement_regle) == 1) {
                    $departement_regle = '0' . $departement_regle;
                }

                $DepId = Departement::where('code', '=', $departement_regle)->first();
                //dd($DepId);
                if ($DepId != null) {
                    $DepId = $DepId->id;
                    echo "<br> ======> Regle_Id($Regle_Id) DepId($DepId)";

                    // exit;
                    $Departement_regles=Departement_regles::where(['regle_id' => $Regle_Id, 'departement_id' => $DepId]);
                    if($Departement_regles !=null){
                        $Departement_regles->regle_id=$Regle_Id;
                        $Departement_regles->departement_id=$DepId;
                        $Departement_regles->save();
                        echo "Departement_regles id trouvé et modifié  : " . $DR . " <br>";

                    }else{
                        Departement_regles::create(['regle_id' => $Regle_Id, 'departement_id' => $DepId]);
                        echo "Departement_regles id : " . $DR . "(Created) <br>";

                    }
                } else {
                    echo "ID Departement introuvable avec le code :" . $departement_regle;
                }
            }
           // exit;
            //Table Regime_regles
            foreach ($Regime_regles as $regime_regle) {
                //$DepId = Regime::where("libelle", "=", $regime_regle)->first()->id;
                $Regime_regles=Regime_regles::where(['regime_id' => $regime_regle, 'regle_id' => $Regle_Id]);
                if($Regime_regles !=null){
                    $Regime_regles->regime_id=$regime_regle;
                    $Regime_regles->regle_id=$Regle_Id;
                    $Regime_regles->save();
                }else{
                    Regime_regles::create(['regime_id' => $regime_regle, 'regle_id' => $Regle_Id]);
                }

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

}
