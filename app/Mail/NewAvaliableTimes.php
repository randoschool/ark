<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAvaliableTimes extends Mailable
{
    use Queueable, SerializesModels;

    public $times;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($times)
    {
        $this->times = $times;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')->view('times');
    }
}
