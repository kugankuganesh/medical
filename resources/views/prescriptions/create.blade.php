@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upload Prescription</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('prescriptions.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Note -->
        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <textarea id="note" class="form-control" name="note">{{ old('note') }}</textarea>
            @error('note')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Delivery Address -->
        <div class="mb-3">
            <label for="delivery_address" class="form-label">Delivery Address</label>
            <input id="delivery_address" class="form-control" name="delivery_address" value="{{ old('delivery_address') }}" required>
            @error('delivery_address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Delivery Time -->
        <div class="mb-3">
            <label for="delivery_time" class="form-label">Delivery Time</label>
            <select id="delivery_time" class="form-control" name="delivery_time" required>
                <option value="08:00-10:00">08:00-10:00</option>
                <option value="10:00-12:00">10:00-12:00</option>
                <option value="12:00-14:00">12:00-14:00</option>
                <option value="14:00-16:00">14:00-16:00</option>
                <option value="16:00-18:00">16:00-18:00</option>
                <option value="18:00-20:00">18:00-20:00</option>
            </select>
            @error('delivery_time')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Images -->
        <div class="mb-3">
            <label for="images" class="form-label">Upload Prescription Images (Max 5)</label>
            <input id="images" class="form-control" type="file" name="images[]" multiple required>
            @error('images')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            @error('images.*')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Upload Prescription</button>
    </form>
</div>
@endsection
