<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminContactSuccess extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build() {
        return $this->from('danghuutien@mail.com') 
            ->subject(env('APP_NAME').'- Thông báo có yêu cầu tư vấn mới !')
            ->view('web.general.mail.contact', [
                'data' => $this->data,
            ]);
    }
}
