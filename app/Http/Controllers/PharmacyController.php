<?php

namespace App\Http\Controllers;
use App\Mail\QuotationSubmitted;
use Illuminate\Support\Facades\Mail;

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
            'quote' => 'required|numeric|min:0',
        ]);

        $prescription = Prescription::findOrFail($id);
        // dd($prescription->user->email);
        $prescription->update([
            'quote' => $request->input('quote'),
            'quoted_by' => auth()->user()->id, // Store the pharmacy user who provided the quote
        ]);

        // Mail::to($prescription->user->email)->send(new QuotationSubmitted($prescription));


        return redirect()->route('pharmacy.prescriptions.index')->with('success', 'Quotation added successfully!');
    }
}
