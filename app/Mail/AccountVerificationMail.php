<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    // public $mailTo;
    public $emailToken;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $emailToken )
    {
        // $this->mailTo   = $mailTo;
        $this->emailToken = $emailToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view( 'emails.account_verification' );
    }
}
