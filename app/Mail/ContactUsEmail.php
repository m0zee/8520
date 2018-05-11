<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUsEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $country;
    public $state;
    public $city;
    public $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $sender, $country, $state, $city, $message )
    {
        $this->sender   = $sender;
        $this->country  = $country;
        $this->state    = $state;
        $this->city     = $city;
        $this->msg      = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from( 'support@pakmaterial.com' )
        ->subject( 'Email Received from Pak Material at ' . date( 'd-m-Y H:i:s' ) )
        ->view( 'emails.contact_us' );
    }
}
