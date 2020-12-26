<?php

namespace App\Mail;

use App\Replay;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Replay $replay)
    {
        $this->email = $replay->email;
        $this->content = $replay->message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('الرد على رسالتك الواردة')
            ->to($this->email)
            ->view('emails.contact');
    }
}
