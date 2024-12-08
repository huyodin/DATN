<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to TRAVEL.PRO')
            ->view('emails.register')
            ->with([
                'name' => $this->user->name,
                'email' => $this->user->email,
                'verificationUrl' => route('verify.email', ['email' => $this->user->email]),
            ]);
    }
}
