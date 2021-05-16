<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Gmail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $header;
    public $pdf;
    public $pdfName;

    /**
     * Create a new message instance.
     *
     * @param $details
     * @param $header
     * @param null $pdf
     * @param null $pdfName
     */
    public function __construct($details, $header, $pdf = null, $pdfName = null)
    {
        $this->details = $details;
        $this->header = $header;
        $this->pdf = $pdf;
        $this->pdfName = $pdfName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->header)
            ->view('email.gmail')
            ->from('petfy.es@gmail.com');
        if ($this->pdf !== null || $this->pdfName !== null)  $this->attachData($this->pdf, $this->pdfName);
        return $this;
    }
}
