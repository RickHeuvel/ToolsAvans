<?php
/**
 * Created by PhpStorm.
 * User: Rick
 * Date: 22-May-18
 * Time: 14:45
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewQuestion extends Mailable
{
    use Queueable, SerializesModels;
    private $info;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($question)
    {
        $this->info = $question;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newquestion')
            ->from('noreply@toolhub.com', config('app.name'))
            ->subject('Nieuwe vraag over:'. $this->info['tool_slug'])
            ->with([
                'tool' => $this->info['tool_slug'],
                'url' => route('tools.show', $this->info['tool_slug'].'#question-'.$this->info->id),
                'text' => $this->info['text'],
                'title' => $this->info['title'],
            ]);
    }
}