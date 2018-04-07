<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConceptToolApproved extends Mailable
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
        return $this->markdown('emails.concepttoolapproved')
                    ->from('noreply@toolhub.com', config('app.name'))
                    ->subject('Je opgestuurde tool is geaccepteerd!')
                    ->with([
                        'url' => route('tools.show', $this->tool->slug),
                    ]);
    }
}
