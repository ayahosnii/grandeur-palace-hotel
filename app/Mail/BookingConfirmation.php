<?php

namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingCode;

    /**
     * Create a new message instance.
     *
     * @param  string  $bookingCode
     * @return void
     */
    public function __construct($bookingCode)
    {
        $this->bookingCode = $bookingCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Confirmation')->view('emails.booking-confirmation');
    }
}
