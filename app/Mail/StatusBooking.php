<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusBooking extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingDetails;
    public $type;

    public function __construct($bookingDetails, $type)
    {
        $this->bookingDetails = $bookingDetails;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->type === 'action') {
            return $this->subject('Kết quả Tour của bạn')
                ->view('emails.status_booking')
                ->with('bookingDetails', $this->bookingDetails);
        } else {
            return $this->subject('Kết quả Tour của bạn')
                ->view('emails.delete_booking')
                ->with('bookingDetails', $this->bookingDetails);
        }
    }
}
