<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    private $info;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contactmessage')
                    ->from('noreply@toolhub.com', config('app.name'))
                    ->subject('Toolhub vraag: '.$this->info['subject'])
                    ->with([
                        'name' => $this->info['name'],
                        'email' =>$this->info['email'],
                        'question' => $this->info['question'],
                        'subject' => $this->info['subject'],
                    ]);
    }
}
