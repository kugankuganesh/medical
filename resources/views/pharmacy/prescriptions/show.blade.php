@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Prescription Details</h2>

    <div class="mb-3">
        <strong>User:</strong> {{ $prescription->user->name }}
    </div>
    <div class="mb-3">
        <strong>Note:</strong> {{ $prescription->note }}
    </div>
    <div class="mb-3">
        <strong>Delivery Address:</strong> {{ $prescription->delivery_address }}
    </div>
    <div class="mb-3">
        <strong>Delivery Time:</strong> {{ $prescription->delivery_time }}
    </div>

    <h4>Prescription Images</h4>
    <div class="row">
        @foreach ($prescription->images as $image)
            <div class="col-md-3">
                <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid" alt="Prescription Image">
            </div>
        @endforeach
    </div>

    <h4 class="mt-4">Prepare Quotation</h4>
    <form method="POST" action="{{ route('pharmacy.prescriptions.quote', $prescription->id) }}">
        @csrf

        <div class="mb-3">
            <label for="quote" class="form-label">Quotation Amount</label>
            <input id="quote" class="form-control" name="quote" type="number" step="0.01" min="0" required>
            @error('quote')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit Quotation</button>
    </form>
</div>
@endsection
