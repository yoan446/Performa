<?php

namespace App\Mail;

use App\Models\Objectifs_user;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ObjectifCreeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $objectif;

    /**
     * Crée une nouvelle instance de message.
     */
    public function __construct(Objectifs_user $objectif)
    {
        $this->objectif = $objectif;
    }

    /**
     * Construction du message.
     */
    public function build()
    {
        return $this->subject('Nouvel Objectif Créé')
                    ->view('emails.objectif_cree')
                    ->with([
                        'objectif' => $this->objectif
                    ]);
    }
}
