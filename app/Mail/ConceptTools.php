<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConceptTools extends Mailable
{
    use Queueable, SerializesModels;

    private $tools;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tools)
    {
        $this->tools = $tools;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.concepttools')
                    ->from('noreply@toolhub.com', config('app.name'))
                    ->subject('Concept tools keuren')
                    ->with([
                        'url' => route('portal') . '?statuses=concept#unjudgedtools',
                        'tools' => $this->tools,
                    ]);
    }
}
