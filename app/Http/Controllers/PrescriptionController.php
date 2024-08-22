<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\PrescriptionImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PrescriptionItem;


class PrescriptionController extends Controller
{
    public function create()
    {
        return view('prescriptions.create');
    }

    public function index()
    {
        $user_id = auth()->id();
        $prescriptions = Prescription::where('user_id', $user_id)
        ->with('items') // Eager load the items relationship
        ->get();

        return view('prescriptions.index', ['prescriptions' => $prescriptions]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'note' => 'nullable|string|max:255',
            'delivery_address' => 'required|string|max:255',
            'delivery_time' => 'required|string|max:255',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $prescription = Prescription::create([
            'user_id' => Auth::id(),
            'note' => $request->input('note'),
            'delivery_address' => $request->input('delivery_address'),
            'delivery_time' => $request->input('delivery_time'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('prescriptions', 'public');

                PrescriptionImage::create([
                    'prescription_id' => $prescription->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('prescriptions.create')->with('success', 'Prescription uploaded successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $item = PrescriptionItem::findOrFail($id);
        $item->status = $request->input('status');
        $item->save();

        return redirect()->back()->with('status', 'Item status updated!');
    }
}
