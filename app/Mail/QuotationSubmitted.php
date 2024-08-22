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

    public function build()
    {
        
                    return $this->view('emails.quotation_submitted')
                    ->with([
                        'prescription' => $this->prescription,
                    ]);             
    }



}


