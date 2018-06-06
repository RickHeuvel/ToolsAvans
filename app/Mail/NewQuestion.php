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
    private $question;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($question)
    {
        $this->question = $question;
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
            ->subject('Nieuwe vraag over '. $this->question->tool->name)
            ->with([
                'tool' => $this->question->tool->name,
                'url' => route('tools.show', $this->question->tool->name.'#question-'.$this->question->id),
                'text' => $this->question->text,
                'title' => $this->question->title,
            ]);
    }
}
