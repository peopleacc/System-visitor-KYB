<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitorApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $visitor;
    public $codeValue;
    public $qrImageUrl;
    // public $logoBase64;  // tambah ini
    public $logoCid = 'logo-kayaba'; // ← kita pakai ini sebagai identifier

    public function __construct($visitor)
    {
        $this->visitor = $visitor;
    }

    // public function build()
    // {
    //     // Logo sebagai base64
    //     $logoPath = public_path('image/kayaba-logo.png');
    //     dd([
    //         'path' => $logoPath,
    //         'exists' => file_exists($logoPath),
    //     ]);
    //     if (file_exists($logoPath)) {
    //         $logoData = base64_encode(file_get_contents($logoPath));
    //         $this->logoBase64 = 'data:image/png;base64,' . $logoData;
    //     }

    //     // Get barcode code
    //     $this->codeValue = null;
    //     if (is_object($this->visitor) && isset($this->visitor->card_qr->code)) {
    //         $this->codeValue = $this->visitor->card_qr->code;
    //     }

    //     // QR image URL
    //     $this->qrImageUrl = null;
    //     if ($this->codeValue) {
    //         $this->qrImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($this->codeValue);
    //     }

    //     return $this->subject('Visitor Disetujui')
    //         ->view('emails.visitor-approved')
    //         ->with([
    //             'codeValue' => $this->codeValue,
    //             'qrImageUrl' => $this->qrImageUrl,
    //             'logoBase64' => $this->logoBase64,
    //         ]);
    // }

    public function build()
    {
        $this->codeValue = $this->visitor->card_qr->code ?? null;

        $this->qrImageUrl = $this->codeValue
            ? 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($this->codeValue)
            : null;

        $logoPath = public_path('image/kayaba-logo.png');

        $viewData = [
            'codeValue' => $this->codeValue,
            'qrImageUrl' => $this->qrImageUrl,
        ];

        $mail = $this->subject('Visitor Disetujui')
            ->view('emails.visitor-approved')
            ->with($viewData);

        // Attach logo sebagai inline image dengan CID
        if (file_exists($logoPath)) {
            $mail->attach($logoPath, [
                'as' => 'logo.png',
                'mime' => 'image/png',
                'cid' => $this->logoCid,   // ← penting!
            ]);
        }

        return $mail;
    }
}