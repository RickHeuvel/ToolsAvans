<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConceptToolFeedbackReceived extends Mailable
{
    use Queueable, SerializesModels;

    private $tool;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tool)
    {
        $this->tool = $tool;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.concepttoolfeedbackreceived')
                    ->from('noreply@toolhub.com', config('app.name'))
                    ->subject('Je hebt feedback gekregen op je opgestuurde tool')
                    ->with([
                        'tool' => $this->tool,
                        'url' => route('tools.show', $this->tool->slug)
                    ]);
    }
}
