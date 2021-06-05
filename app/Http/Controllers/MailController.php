<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Zalazdi\LaravelImap\Client;
use Zalazdi\LaravelImap\Mailbox;
use App\Email;
use App\Fiche;
use App\Message;
use App\Piece_jointe;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MailController extends GlobaleController {

   public static function openImapConnection() {
      $oClient = new \Webklex\IMAP\Client([
         'host' => 'poulpe.o2switch.net',
         'port' => 993,
         'encryption' => 'ssl',
         'validate_cert' => true,
         'username' => Auth::user()->email,
         'password' => Auth::user()->email_password,
         'protocol' => 'imap'
      ]);
      return $oClient;
      /*if (!$oClient->connection) {
          Session::flash('message-email', 'Votre adresse mail ' . Auth::user()->email . ' n\'est pas configé');
          Session::flash('alert-class-mail', 'alert-danger');
          return null;
      } else {
          return $oClient;
      }*/

   }


   public function getMailForm($fiche_id) {
      $fiche = Fiche::find($fiche_id);
      $templates = Template::all();
      return view('emails.mail-modal', compact('fiche', 'templates'));
   }

   public function getTemplateInfos($template_id) {
      $template = Template::find($template_id);
      $Vars = $template->Vars;
      //dd($Vars);
      foreach($Vars as $key0 => $var)
         foreach($var as $key => $champ)
            $Vars[$key0][$key] = $key;

      $fiche = Fiche::find(18);

      /*if(!is_null($fiche->personne->conjoint())){
         $conjoint = \App\Personne::find($fiche->personne->conjoint()->id);
      }else{
         $conjoint = null;
      }*/

      $Vars1 = array(
         "prospect" => array(
            "nom" => $fiche->personne->nom,
            "prenom" => $fiche->personne->nom,
            "regime" => $fiche->personne->regime->valeur,
            "datenaissance" => $fiche->personne->date_naissance),
         "conjoint" => array(
            "conjoint_nom" => @$fiche->personne->conjoint()->nom,
            "conjoint_prenom" => @$fiche->personne->conjoint()->prenom,
            "conjoint_regime" => @$fiche->personne->conjoint()->valeur,
            "conjoint_datenaissance" => @$fiche->personne->conjoint()->date_naissance),
         "details_fiche" => array(
            "nb_enfants" => @sizeof($fiche->personne->enfants()),
            "date_effect" => $fiche->date_effet,
            "Tel1" => $fiche->telephone_1,
            "Tel2" => $fiche->telephone_2,
            "Tel3" => $fiche->telephone_3,
            "email" => $fiche->personne->details->email,
            "adresse" => $fiche->personne->details->adresse,
            "ville" => $fiche->personne->details->laville->name

         ),
         "details_agent" => array(
            "nom_agent" => Auth::user()->nom,
            "agent_prenom" => Auth::user()->prenom,
            "agent_email" => Auth::user()->email,
            "agent_telephone" => Auth::user()->telephone,
            "agent_poste" => Auth::user()->titre,
         )
      );
      $signature_template = Template::where("nom", "=", "Signature Mail")->first();
      foreach($Vars as $kkey => $var)
         $template->template = str_replace($Vars[$kkey], $Vars1[$kkey], $template->template);
      $signature_template->template = str_replace($Vars[$kkey], $Vars1[$kkey], $signature_template->template);
      if($template_id=="13") {
         $template->template = str_replace("__", "", "<br><br><br>".$signature_template->template );
      } else {
         $template->template = str_replace("__", "", $template->template . "<br>" . $signature_template->template);
      }

      return $this->sendResponse($template, '');
   }


   public function listeMails() {
      return view('emails.liste-mail');
   }

   public function nouveauMailForm() {
      $templates = Template::all();
      return view('emails.nouveau-mail', compact("templates"));
   }

   public function nouveauMail(Request $request) {
      /*$this->validate($request, [
      //          'objet' => 'required',
      //          'recepteur' => 'required|email',
      //          'message' => 'required|min:10',
         'pieces_jointes.*' => 'mimes:jpg,jpeg,png,bmp,pdf,txt,word,xlsx,xls|max:20000',
      ]);*/
      try {
         $recepteurs_emails = explode(",", $request->recepteur);
         DB::beginTransaction();
         //enregistrement d'email
         $user = Auth::user();
         $emailId = Email::create(['message' => $request->message, 'emetteur_id' => $user->id, 'objet' => $request->objet, 'recepteur_email' => $request->recepteur])->id;

         //enregistrement des pieces jointes
         if($request->hasfile('pieces_jointes')) {

            foreach($request->file('pieces_jointes') as $file) {

               $attributes = [];
               $fileName = time() . '-' . $file->getClientOriginalName();
               $destinationPath = public_path('/uploads/pieces-jointes/emails');
               $file->move($destinationPath, $fileName);
               $attributes['url'] = $fileName;
               $attributes['description'] = '';
               $attributes['email_id'] = $emailId;
               $piece = Piece_jointe::create($attributes);

            }
         }
         //dd($emailId);
         $email = Email::findOrFail($emailId);
         // dd($email);
         $message_pieces_jointes = $email->piece_jointes;
//dd($message_pieces_jointes);
         $data = [
            'request' => $request,
            'message_pieces_jointes' => $message_pieces_jointes,
            'user' => $user
         ];
         //envoi d'email
         Mail::send(['html' => 'emails.mail-body'], ['data' => $data], function($message) use ($data, $recepteurs_emails) {
            //$message->to($data['request']->recepteur);
            $message->to($recepteurs_emails);
            $message->cc(Auth::user()->email);
            $message->subject($data['request']->objet);
            foreach($data['message_pieces_jointes'] as $piece) {
               $message->attach('https://' . $_SERVER['SERVER_NAME'] . '/uploads/pieces-jointes/emails/' . $piece->url);
               //$message->attach('http://' . $_SERVER['SERVER_NAME'] . '/uploads/pieces-jointes/emails/' . $piece->url);
            }
            $message->from($data['user']->email, Auth::user()->nom . " " . Auth::user()->prenom);
         });

         //mail copie contact
         Mail::send(['html' => 'emails.mail-body'], ['data' => $data], function($message) use ($data, $recepteurs_emails) {
            $message->to("contact@acsassurance.com");
            //$message->cc("support.technique@acsassurance.com");
            //$message->cc("keyprogs@gmail.com");
            //$message->cc('assurpourtous.ma@gmail.com');
            $message->cc('sanaa.hafhaf@assurance-courtage-serenite.com');
            //$message->cc('houria.houjri@acsassurance.com');
            $message->subject($data['request']->objet . " (CRM de " . Auth::user()->email . " à " . $data['request']->recepteur . ") ");
            foreach($data['message_pieces_jointes'] as $piece) {
               $message->attach('https://' . $_SERVER['SERVER_NAME'] . '/uploads/pieces-jointes/emails/' . $piece->url);
            }
            $message->from($data['user']->email, Auth::user()->nom . " " . Auth::user()->prenom);
         });


         Session::flash('message', 'Votre Email a bien été envoyé aux destinataires (' . implode(",", $recepteurs_emails) . ')');
         Session::flash('alert-class', 'alert-success');
         DB::commit();
         return redirect()->back();
      } catch(\Exception $e) {
         DB::rollback();
         Session::flash('message', $e->getMessage());
         Session::flash('alert-class', 'alert-warning');
         return redirect()->back();
      }
   }

   public function readMail($folder, $mail_id) {
      $oClient = $this->openImapConnection();
      $oClient->connect();
      $oFolder = $oClient->getFolder($folder);
      //$oFolder->query();
      //$oMessage = $oFolder->getMessage($mail_id);
      $aMessage = $oFolder->messages()->all()->get();


      foreach($aMessage as $oMessage) {
         echo $oMessage->id() . '<br />';
         echo $oMessage->getSubject() . '<br />';
         echo 'Attachments: ' . $oMessage->getAttachments()->count() . '<br />';
         echo $oMessage->getHTMLBody(true);


      }


      //dd($oMessage->getHTMLBody(true));
      //dd($oMessage->getHTMLBody());
      //return view('emails.mail-infos',compact('oMessage','folder'));
   }

   public function mails($folder) {
      //$oClient = Session::get('imap');
      $oClient = $this->openImapConnection();
      $oClient->connect();
      $oFolder = $oClient->getFolder($folder);
      $aCollection = collect($oFolder->getMessages());
      $page = Input::get('page', 1);
      $per_page = 15;
      $paginator = new LengthAwarePaginator(
         $aCollection->forPage($page, $per_page), $aCollection->count(), $per_page, $page
      );
      return view('emails.liste-mail', compact('paginator', 'folder'));

      /*$aCollection = collect($oFolder->getMessages());
      $aPage = $aCollection->forPage(2, 15);

      foreach ($aPage as $oMessage) {
          echo $oMessage->subject . '<br />';
      }*/

   }

   public function enregistrerMail(Request $request) {

      $this->validate($request, [
         'objet' => 'required',
         'recepteur' => 'required|email',
         'message' => 'required|min:10',
         'pieces_jointes.*' => 'mimes:jpg,jpeg,png,bmp,pdf,txt,word,xlsx,xls|max:20000',
      ]);

      try {
         DB::beginTransaction();
         //enregistrement du message
         $user = Auth::user();
         $emailId = Email::create(['message' => $request->message, 'emetteur_id' => $user->id, 'objet' => $request->objet, 'recepteur_email' => $request->recepteur])->id;

         //enregistrement des pieces jointes
         if($request->hasfile('pieces_jointes')) {
            foreach($request->file('pieces_jointes') as $file) {
               $attributes = [];
               $fileName = time() . '-' . $file->getClientOriginalName();
               $destinationPath = public_path('/uploads/pieces-jointes/emails');
               $file->move($destinationPath, $fileName);
               $attributes['url'] = $fileName;
               $attributes['description'] = '';
               $attributes['email_id'] = $emailId;
               Piece_jointe::create($attributes);
            }
         }
         $email = Email::findOrFail($emailId);
         $message_pieces_jointes = $email->piece_jointes;
         $data = [
            'request' => $request,
            'message_pieces_jointes' => $message_pieces_jointes,
            'user' => $user
         ];
         Session::flash('message', 'votre message a bien été enregistré comme brouillon');
         Session::flash('alert-class', 'alert-success');
         DB::commit();
         return redirect()->back();
      } catch(\Exception $e) {
         DB::rollback();
         Session::flash('message', $e->getMessage());
         Session::flash('alert-class', 'alert-warning');
         return redirect()->back();
      }
   }


   //=============================== Zalazdi =================================

   public function zalazdi() {
      $config = config('imap');
      $client = new Client($config['accounts']['default']);
      //$client = new Client();
      $client->connect();

      $mailboxes = $client->getMailboxes();
      foreach($mailboxes as $mailbox) {
         dump($mailbox->getMessages());
      }
   }


}
