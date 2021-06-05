<?php

namespace App\Http\Controllers;
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

class MailController extends GlobaleController
{

    public function getMailForm($fiche_id)
    {
        $fiche = Fiche::find($fiche_id);
        $templates = Template::all();
        return view('emails.mail-modal', compact('fiche', 'templates'));
    }

    public function getTemplateInfos($template_id)
    {
        $template = Template::find($template_id);
        return $this->sendResponse($template, '');
    }


    public function listeMails()
    {
        return view('emails.liste-mail');
    }

    public function mailDetails($mail_id)
    {
        return view('emails.mail-infos');
    }

    public function nouveauMailForm()
    {
        return view('emails.nouveau-mail');
    }

    public function nouveauMail(Request $request)
    {

        $this->validate($request, [
            'objet' => 'required',
            'recepteur' => 'required|email',
            'message' => 'required|min:10',
            'pieces_jointes.*' => 'mimes:jpg,jpeg,png,bmp,pdf,txt,word,xlsx,xls|max:20000',
        ]);

        try {
            DB::beginTransaction();
            //enregistrement d'email
            $user = Auth::user();
            $emailId = Email::create(['message' => $request->message, 'emetteur_id' => $user->id, 'objet' => $request->objet, 'recepteur_email' => $request->recepteur])->id;

            //enregistrement des pieces jointes
            if ($request->hasfile('pieces_jointes')) {
                foreach ($request->file('pieces_jointes') as $file) {
                    $attributes = [];
                    $fileName = time().'-'.$file->getClientOriginalName();
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
            //envoi d'email
            Mail::send('email.mail-body', $data, function ($message) use ($data) {
                $message->to($data['request']->emetteur_email,'')
                    ->subject($data['request']->objet);
                foreach ($data['message_pieces_jointes'] as $piece) {
                    $message->attach('http://crm.acsassurance.com/uploads/pieces-jointes/emails/' . $piece->url);
                }
                $message->from($data['user']->email, 'GESTION ACS ASSURANCE');
            });


            Session::flash('message', 'Votre demande a été bien traitée');
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-warning');
            return redirect()->back();
        }
    }

    public function enregistrerMail(Request $request)
    {

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
            if ($request->hasfile('pieces_jointes')) {
                foreach ($request->file('pieces_jointes') as $file) {
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
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-warning');
            return redirect()->back();
        }
    }


    //=============================== Zalazdi =================================

    public function zalazdi(){
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
