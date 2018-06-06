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
use App\ToolQuestion;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewAnswer extends Mailable
{
    use Queueable, SerializesModels;
    private $answer;
    private $tool;
    private $question;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($answer,$tool)
    {
        $this->answer = $answer;
        $this->tool = $tool;


    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newanswer')
            ->from('noreply@toolhub.com', config('app.name'))
            ->subject('Nieuw antwoord op je vraag over '. $this->tool->name)
            ->with([
                'tool' => $this->tool->name,
                'url' => route('tools.show', $this->tool->slug.'#answer-'.$this->answer->id),
                'answer' => $this->answer
            ]);
    }
}
