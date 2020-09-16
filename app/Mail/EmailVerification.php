<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email_verification_code)
    {
        $this->name = $name;
        $this->email_verification_code = $email_verification_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@makarya.in', 'Makarya Team')
                    ->subject('Verifikasi Email Makarya')
                    ->markdown('template.email-verification')
                    ->with([
                'name' => $this->name,
                'email_verification_code' => $this->email_verification_code
            ]);
    }
}
