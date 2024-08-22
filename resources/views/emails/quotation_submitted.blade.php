@dd($prescription);
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Quotation Submitted</h1>

    <p>Dear {{ $prescription->user->name }},</p>

    <p>A quotation has been submitted for your prescription.</p>

    <p><strong>Details:</strong></p>
    <ul>
        <li><strong>Note:</strong> {{ $prescription->note }}</li>
        <li><strong>Delivery Address:</strong> {{ $prescription->delivery_address }}</li>
        <li><strong>Delivery Time:</strong> {{ $prescription->delivery_time }}</li>
        <li><strong>Quotation Amount:</strong> {{ $prescription->quote }}</li>
    </ul>

    <p>Thank you for using our service.</p>


    <p>Thanks</p>
</body>
</html>
