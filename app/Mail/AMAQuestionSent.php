<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AMAQuestionSent extends Mailable
{
    use Queueable, SerializesModels;

    public $question;

    /**
     * Create a new message instance.
     *
     * @param $question
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
        return $this->markdown('ama.mail')
            ->subject('AMA #' . $this->question->id);
    }
}
