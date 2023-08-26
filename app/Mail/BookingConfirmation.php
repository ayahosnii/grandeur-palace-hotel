<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $bookingCode;
    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct($bookingCode)
    {
        $this->bookingCode = $bookingCode;
    }

    public function build()
    {
        return $this->subject('Booking Confirmation')->view('emails.booking-confirmation');
    }
}
