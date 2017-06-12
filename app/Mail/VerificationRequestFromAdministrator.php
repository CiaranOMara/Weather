<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerificationRequestFromAdministrator extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->subject = "Verify your email address for your " . env('APP_NAME') . ' account';

        $this->name = $user->name;
        $this->token = $user->verification_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.verification_from_administrator')
            ->with([
                'actionText' => 'Verify email address',
                'actionUrl' => route("auth.confirm", $this->token)
            ]);
    }
}
