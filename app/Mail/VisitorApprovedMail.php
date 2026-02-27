<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class VisitorApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $visitor;
    public $codeValue;
    public $qrImageUrl;

    public function __construct($visitor)
    {
        $this->visitor = $visitor;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Get barcode code from visitor_acc
        $this->codeValue = null;
        if (is_object($this->visitor) && isset($this->visitor->barcode)) {
            $this->codeValue = $this->visitor->barcode;
        }

        // Generate QR code image URL via public API (works in all email clients)
        $this->qrImageUrl = null;
        if ($this->codeValue) {
            $this->qrImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($this->codeValue);
        }

        return $this->subject('Visitor Disetujui')
            ->view('emails.visitor-approved')
            ->with([
                'codeValue' => $this->codeValue,
                'qrImageUrl' => $this->qrImageUrl,
            ]);
    }
}
