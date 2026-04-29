<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header-img {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color: #1e3a8a;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 30px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 3px 0;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .main-table th {
            background: #f3f4f6;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .main-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .payment-box {
            background: #f9fafb;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .total-row {
            font-weight: bold;
            background: #f3f4f6;
        }
    </style>
</head>

<body>
    <div style="text-align: center;">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/header.jpg'))) }}"
            class="header-img">
    </div>

    <div class="title">INVOICE ATTACHMENT</div>
    <div class="subtitle">Registration ID: {{ $order->order_code }}</div>

    <table class="info-table">
        <tr>
            <td width="150">Name</td>
            <td>: {{ $order->peserta->user->name }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: {{ $order->peserta->user->email }}</td>
        </tr>
        <tr>
            <td>Payment Code</td>
            <td>: {{ $order->order_code }}</td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Registration</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1.</td>
                <td>{{ $order->event->name }}</td>
                <td>{{ $order->qty }}</td>
                <td>IDR {{ number_format($order->total, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">Total</td>
                <td>IDR {{ number_format($order->total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="payment-box">
        <strong>Payment Method: Bank Transfer</strong><br>
        Bank Name: Mandiri KCP Jakarta RSCM<br>
        Account Name: Perkumpulan Dokter Spesialis Urologi<br>
        Account Number: 122-00-1139401-5
    </div>

    <p style="font-style: italic; margin-top: 20px;">* The registration confirmation letter will be provided once your
        payment arrives in our bank account.</p>
</body>

</html>
