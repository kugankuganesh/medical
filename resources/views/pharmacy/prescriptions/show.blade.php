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

    <!-- <h4 class="mt-4">Prepare Quotation</h4>
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
    </form> -->
</div>

<hr >

<div class="container">
    <h2>Add Prescription Items</h2>

    <div class="mb-3">
        <label for="drug_name" class="form-label">Drug Name</label>
        <input id="drug_name" class="form-control" type="text" required>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input id="quantity" class="form-control" type="number" min="1" required>
    </div>

    <div class="mb-3">
        <label for="amount" class="form-label">Amount</label>
        <input id="amount" class="form-control" type="number" step="0.01" min="0" required>
    </div>

    <button type="button" id="addItem" class="btn btn-secondary">Add</button>

    <h4 class="mt-4">Items List</h4>
    <div id="itemsList" class="card">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <!-- Dynamically added items will appear here -->
            </ul>
        </div>
        <div class="card-footer">
            <strong>Total: $<span id="allTotal">0.00</span></strong>
        </div>
    </div>

    <!-- Form submission -->
    <form id="prescriptionForm" method="POST" action="{{ route('pharmacy.prescriptions.quote', $prescription->id) }}">
        @csrf
        <input type="hidden" id="items_data" name="items_data">

        <button type="submit" class="btn btn-primary mt-3">Submit Prescription</button>
    </form>
</div>


@section('scripts')
<script>
  $(document).ready(function() {
    let itemsArray = [];
    let allTotal = 0;

    $('#addItem').on('click', function() {
        // Get the values from the input fields
        let drugName = $('#drug_name').val().trim();
        let quantity = $('#quantity').val().trim();
        let amount = $('#amount').val().trim();

        // Validate inputs
        if(drugName === '' || quantity === '' || quantity <= 0 || amount === '' || amount <= 0) {
            alert('Please enter valid Drug Name, Quantity, and Amount.');
            return;
        }

        // Calculate item total
        let itemTotal = (quantity * amount).toFixed(2);

        // Add item to the array
        let item = { name: drugName, quantity: quantity, amount: amount, total: itemTotal };
        itemsArray.push(item);

        // Append item to the items list view
        $('#itemsList .list-group').append(`
            <li class="list-group-item d-flex justify-content-between align-items-center">
                ${drugName} - ${amount} x ${quantity} = $${itemTotal}
            </li>
        `);

        // Update the all items total (allTotal)
        allTotal = (parseFloat(allTotal) + parseFloat(itemTotal)).toFixed(2);
        $('#allTotal').text(allTotal);

        // Update the hidden input field with the JSON string
        $('#items_data').val(JSON.stringify(itemsArray));

        // Clear the input fields
        $('#drug_name').val('');
        $('#quantity').val('');
        $('#amount').val('');
    });
});

</script>
@endsection
@endsection
