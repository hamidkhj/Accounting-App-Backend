<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class NewPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $newPass)
    {
        $this->user = $user;
        $this->newPass = $newPass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com', 'Example')->view('mail.newPassword')->with([
            'password' => $this->newPass,
            'firstName' => $this->user->first_name,
            'lastName' => $this->user->last_name,
        ]);
    }
}
