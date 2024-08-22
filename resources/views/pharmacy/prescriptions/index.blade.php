@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Prescriptions</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Delivery Address</th>
                <th>Delivery Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prescriptions as $prescription)
                <tr>
                    <td>{{ $prescription->id }}</td>
                    <td>{{ $prescription->user->name }}</td>
                    <td>{{ $prescription->delivery_address }}</td>
                    <td>{{ $prescription->delivery_time }}</td>
                    <td>
                        <a href="{{ route('pharmacy.prescriptions.show', $prescription->id) }}" class="btn btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
