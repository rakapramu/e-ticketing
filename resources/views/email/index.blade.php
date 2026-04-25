<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>E-Ticket</title>
</head>

<body style="margin:0;padding:0;background:#ffffff;font-family:Arial,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:20px 0;">
        <tr>
            <td align="center">

                <!-- CARD -->
                <table width="420" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:16px;overflow:hidden;color:#000000;box-shadow:0 10px 30px rgba(0,0,0,0.4);">

                    <!-- HEADER -->
                    <tr>
                        <td style="background:linear-gradient(135deg,#f97316,#ea580c);padding:24px;text-align:center;">
                            <h1 style="margin:0;font-size:22px;color:#fff;">
                                🎫 E-Ticket Anda
                            </h1>
                            <p style="margin:6px 0 0;font-size:13px;color:#ffedd5;">
                                Tunjukkan QR ini saat registrasi
                            </p>
                        </td>
                    </tr>

                    <!-- CONTENT -->
                    <tr>
                        <td style="padding:24px;">

                            <p style="margin:0 0 12px;font-size:14px;">
                                Halo <strong>{{ $order->peserta->name ?? 'Peserta' }}</strong>,
                            </p>

                            <p style="margin:0 0 20px;font-size:13px;color:#000000;">
                                Terima kasih telah melakukan pemesanan. Berikut detail tiket Anda:
                            </p>

                            <!-- INFO -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="font-size:13px;">
                                <tr>
                                    <td style="padding:6px 0;color:#000000;">Kode Order</td>
                                    <td align="right"><strong>{{ $order->order_code }}</strong></td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 0;color:#121212;">Jumlah Tiket</td>
                                    <td align="right">{{ $order->qty }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 0;color:#0a0a0a;">Total</td>
                                    <td align="right" style="color:#f97316;font-weight:bold;">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </table>

                            <!-- QR -->
                            <div style="text-align:center;margin:24px 0;">
                                <div style="background:#fff;padding:12px;border-radius:12px;display:inline-block;">
                                    <img
                                        src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ $order->order_code }}">
                                </div>
                                <p style="font-size:11px;color:#9ca3af;margin-top:10px;">
                                    Scan QR ini saat masuk venue
                                </p>
                            </div>

                            <!-- NOTICE -->
                            <div
                                style="background:#ffffff;padding:12px;border-radius:10px;font-size:12px;color:#000000;">
                                ⚠️ Tiket hanya berlaku 1x scan<br>
                                ⚠️ Simpan email ini atau screenshot QR
                            </div>

                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="padding:16px;text-align:center;font-size:11px;color:#6b7280;">
                            © {{ date('Y') }} Event Anda • All rights reserved
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
