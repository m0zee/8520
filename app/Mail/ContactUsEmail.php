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
    public $name;
    public $country;
    public $state;
    public $city;
    public $msg;
    public $contact;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $sender, $name, $country, $state, $city, $message, $contact )
    {
        $this->sender   = $sender;
        $this->name     = $name;
        $this->country  = $country;
        $this->state    = $state;
        $this->city     = $city;
        $this->msg      = $message;
        $this->contact  = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from( 'support@pakmaterial.com' )
        ->subject( 'Email Received from Pakmaterial at ' . date( 'd-m-Y H:i:s' ) )
        ->view( 'emails.contact_us' );
    }
}
