<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        @page {
            margin: 0;

        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 5px;
        }

        .wrapper {
            width: 100%;
        }

        .ticket {
            max-width: 420px;
            margin: auto;
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        /* HEADER */
        .header {
            background: #f97316;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 6px 0 0;
            font-size: 12px;
        }

        /* BODY */
        .content {
            padding: 20px;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 8px;
            border-bottom: 1px dashed #e5e7eb;
            padding-bottom: 6px;
        }

        .label {
            color: #6b7280;
        }

        .value {
            font-weight: bold;
            color: #111827;
        }

        /* QR */
        .qr-box {
            text-align: center;
            margin-top: 20px;
        }

        .qr-inner {
            display: inline-block;
            padding: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #fff;
        }

        .qr-note {
            font-size: 11px;
            color: #6b7280;
            margin-top: 6px;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
            padding: 12px;
            border-top: 1px solid #e5e7eb;
        }

        .notice {
            margin-top: 15px;
            background: #fff7ed;
            padding: 10px;
            font-size: 11px;
            border-radius: 8px;
            color: #9a3412;
        }
    </style>
</head>

<body>

    <div class="wrapper">

        <div class="ticket">

            <!-- HEADER -->
            <div class="header">
                <h1>{{ config('app.name') }} {{ date('Y') }}</h1>
                <p>E-Ticket Resmi</p>
            </div>

            <!-- CONTENT -->
            <div class="content">

                <div class="title">Detail Pemesanan</div>

                <div class="row">
                    <span class="label">Order ID :</span>
                    <span class="value">{{ $order->order_code }}</span>
                </div>

                <div class="row">
                    <span class="label">Nama :</span>
                    <span class="value">{{ $order->peserta->name }}</span>
                </div>

                <div class="row">
                    <span class="label">Jumlah Tiket :</span>
                    <span class="value">{{ $order->qty }}</span>
                </div>

                <div class="row">
                    <span class="label">Total :</span>
                    <span class="value" style="color:#f97316;">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </span>
                </div>

                <!-- QR -->
                <div class="qr-box">
                    <div class="qr-inner">
                        <img src="data:image/png;base64,{{ $qr }}" width="140">
                    </div>
                    <div class="qr-note">
                        Scan QR ini saat masuk venue
                    </div>
                </div>

                <!-- NOTICE -->
                <div class="notice">
                    ⚠️ Tiket hanya berlaku untuk 1x scan<br>
                    ⚠️ Simpan tiket ini atau screenshot QR
                </div>

            </div>

            <!-- FOOTER -->
            <div class="footer">
                © {{ date('Y') }} {{ config('app.name') }} • All rights reserved
            </div>

        </div>

    </div>

</body>

</html>
