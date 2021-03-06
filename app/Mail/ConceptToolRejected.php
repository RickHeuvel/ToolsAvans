<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConceptToolRejected extends Mailable
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
        return $this->markdown('emails.concepttoolrejected')
                    ->from('noreply@toolhub.com', config('app.name'))
                    ->subject('Je opgestuurde tool is geweigerd')
                    ->with([
                        'tool' => $this->tool
                    ]);
    }
}
