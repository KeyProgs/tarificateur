<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Devis extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $ObjetDevis = array(
        'NomCompagnie' => null,
        'NomGamme' => null,
        'NomFormule' => null,
        'Personnes' => array(
            'Prospect' => null,
            'Conjoint' => null,
            'Enfants' => null,
        ),
        'DateEffet' => null,
        'Cotisation' => null,
        'Numero' => null,
        'Numero' => null,
    );

    Public $Volet = array(
        'NomVolet' => array(
            'sous_volet_id'=> array(
                'sous_volet'=>'',
                'valeur'=>''
            ),
            'sous_volet_id'=> 'sous_volet',
            'sous_volet_id'=> 'sous_volet',
        ),
        'NomVolet' => array(
            'sous_volet_id'=> array(
                'sous_volet'=>'',
                'valeur'=>''
            ),
            'sous_volet_id'=> 'sous_volet',
            'sous_volet_id'=> 'sous_volet',
        ),
    );

    public function __construct($ObjetDevis)
    {
        $this->ObjetDevis = $ObjetDevis;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name')
            ->from('example@example.com')
            ->with($this->ObjetDevis);
    }
}
