<?php

namespace App\Mail;

use App\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmReservation extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    /**
     * Create a new message instance.
     * @param $reservation
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $teacherName = $this->reservation->teacher->name;
        $studentName = $this->reservation->student->name;
        $course = $this->reservation->course->name;

        return $this->view('emails.confirm_reservation',
            compact('teacherName', 'studentName', 'course'));
    }
}
