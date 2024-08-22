<!-- resources/views/prescriptions/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Prescriptions</h1>

    @foreach ($prescriptions as $prescription)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Prescription ID: {{ $prescription->id }}</h5>
                <p class="card-text">Note: {{ $prescription->note }}</p>
                <p class="card-text">Delivery Address: {{ $prescription->delivery_address }}</p>
                <p class="card-text">Delivery Time: {{ $prescription->delivery_time }}</p>

                <h6>Items:</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prescription->items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->amount, 2) }}</td>
                                    <td>${{ number_format($item->total, 2) }}</td>
                                    <td>{{ ucfirst($item->status) }}</td>
                                    <td>
                                        @if($item->status === 'pending')
                                            <form action="{{ route('prescription.items.updateStatus', $item->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="accepted">
                                                <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                            </form>
                                            <form action="{{ route('prescription.items.updateStatus', $item->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No items found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
