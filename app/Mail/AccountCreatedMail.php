<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AccountCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // Truyền user vào view

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Chào mừng bạn đến với Website của chúng tôi!')
            ->markdown('emails.account_created');
    }
}
