<?php

namespace App\Jobs;

use App\Reservation;
use App\Mail\ReservationDenied;
use App\Mail\ReservationConfirmed;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendReservationStatusMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $emailType;
    public $studentEmail;
    public $reservation;

    /**
     * Create a new job instance.
     *
     * @param String $studentEmail - Email address of the student
     * @param String $emailType - Type of the email, Confirmed or Denied
     * @param Reservation $reservation
     */
    public function __construct(string $studentEmail, string $emailType, Reservation $reservation)
    {
        $this->studentEmail = $studentEmail;
        $this->emailType = $emailType;
        $this->reservation = $reservation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo "Reservation: ";
        echo $this->reservation;
        if ($this->emailType == 'confirmed') {
            Mail::to($this->studentEmail)->send(new ReservationConfirmed($this->reservation));
        } else if ($this->emailType == 'denied') {
            Mail::to($this->studentEmail)->send(new ReservationDenied($this->reservation));
        } else {
            echo "Not a viable mail option!";
        }
    }
}
