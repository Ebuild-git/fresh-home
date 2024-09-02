<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class forget extends Mailable
{
    use Queueable, SerializesModels;

    public $user,$url;
    public function __construct($user,$url)
    {
        $this->user = $user;
        $this->url = $url;
    }


    public function build()
    {
        return $this->to($this->user)
            ->view('Mail.forget')
            ->subject(config('app.name') . ' Réinitialiser le mot de passe')
            ->from("no_reply@fresh-home.store", "Réinitialiser le mot de passe")
            ->with([
                'user' => $this->user,
                'url' => $this->url
            ]);

    }
}
