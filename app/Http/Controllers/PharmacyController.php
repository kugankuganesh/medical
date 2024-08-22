<?php

namespace App\Http\Controllers;
use App\Mail\QuotationSubmitted;
use Illuminate\Support\Facades\Mail;
use App\Models\PrescriptionItem;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with('user', 'images')->get();
        return view('pharmacy.prescriptions.index', compact('prescriptions'));
    }

    public function show($id)
    {
        $prescription = Prescription::with('user', 'images')->findOrFail($id);
        return view('pharmacy.prescriptions.show', compact('prescription'));
    }


    public function storeQuote(Request $request, $id)
    {
        $request->validate([
            'items_data' => 'required|json',
        ]);
        
        $prescription = Prescription::findOrFail($id);
        
        $items = json_decode($request->items_data, true);
        
        foreach ($items as $item) {
           
            PrescriptionItem::create([
                'prescription_id' => $prescription->id,
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'amount' => $item['amount'],
                'total' => $item['total'],
            ]);
        }

        // Update the prescription with the quote
        $prescription->update([
            'quote' => $request->input('quote'),
            'quoted_by' => auth()->user()->id, 
        ]);

        // if ($prescription->user) {
        //     Mail::to($prescription->user->email)->send(new QuotationSubmitted($prescription));
        // } else {
        //     // Log or handle the situation where user is null
        //     Log::error('No user associated with this prescription.');
        //     return redirect()->back()->with('error', 'No user associated with this prescription.');
        // }

        return redirect()->route('pharmacy.prescriptions.index')->with('success', 'Quotation submitted successfully.');
    }

}
