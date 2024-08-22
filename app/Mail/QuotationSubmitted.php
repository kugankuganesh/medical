<?php



namespace App\Mail;

use App\Models\Prescription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $prescription;

    public function __construct(Prescription $prescription)
    {
        $this->prescription = $prescription;
    }

    // public function build()
    // {
    //     return $this->subject('Your Prescription Quotation')
    //                 ->view('emails.quotation_submitted');
    // }

    public function build()
{
    return $this->subject('Test Email')
                ->view('emails.test'); // Test view
}
}


