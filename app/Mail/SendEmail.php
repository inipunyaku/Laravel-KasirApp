<?php

namespace App\Mail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    public $dataMail;
    public $datadetail;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataMail, $datadetail)
    {
        $this -> dataMail = $dataMail;
        $this ->datadetail = $datadetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Struk Pembelian Kamu')->view('mail.mail');
    }
}
