<?php

namespace App\Http\Controllers;

use App\Mail\TicketMail;
use App\Models\Event;
use App\Models\Gate;
use App\Models\Gelar;
use App\Models\Order;
use App\Models\Peserta;
use App\Models\RegisUlang;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class IndexController extends Controller
{
    public function index()
    {
        $data = Event::where('is_active', '1')->get();
        $gelar = Gelar::get();
        return view('front.index', compact('data', 'gelar'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'event_id' => 'required',
            'gelar_id' => 'required',
            'alamat' => 'required',
            'nik' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $peserta = DB::table('pesertas')->where('email', $request->email)->first();
            if ($peserta) {
                $peserta_id = $peserta->id;
            } else {

                $peserta = Peserta::create([
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => $request->email,
                    'no_wa' => $request->phone,
                    // 'tanggal_lahir' => $request->birthdate,
                    'alamat' => $request->alamat,
                    'nik' => $request->nik,
                    'gelar_id' => $request->gelar_id
                ]);
                $peserta_id = $peserta->id;
            }

            $ticket = Event::findOrFail($request->event_id);

            $subtotal = $ticket->final_price * $request->qty;
            $total = $subtotal;

            $orderCode = 'ORD-' . strtoupper(Str::random(8));
            $order = Order::create([
                'order_code' => $orderCode,
                'peserta_id' => $peserta_id,
                'event_id' => $request->event_id,
                'total' => $total,
                'qty' => $request->qty,
                'status' => 'pending',
            ]);

            $qrBase64 = base64_encode(
                QrCode::format('svg')
                    ->size(250)
                    ->generate($orderCode)
            );

            // ── KIRIM EMAIL ──
            Mail::to($request->email)->send(
                new TicketMail($order, $qrBase64)
            );
            DB::commit();
            return redirect()->route('success', $order)->with('success', 'Peserta berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function success(Order $order)
    {
        $qrCode = QrCode::size(150)->generate($order->order_code);
        return view('front.success', compact('order', 'qrCode'));
    }

    public function scan($gate)
    {
        $gate = Gate::findOrFail($gate);
        if (!$gate) {
            abort(404, 'Gate tidak ditemukan.');
        }
        return view('front.scan', compact('gate'));
    }

    public function ticket(Order $order)
    {
        $qr = base64_encode(
            QrCode::format('svg')->size(200)->generate($order->order_code)
        );

        $pdf = Pdf::loadView('front.pdf.ticket', compact('order', 'qr'))
            ->setPaper([0, 0, 420, 450], 'portrait');

        return $pdf->download('tiket-' . $order->order_code . '.pdf');
    }

    public function verify(Request $request, $code)
    {
        $order = Order::with('regisUlang', 'peserta')->where('order_code', $code)->first();
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Kode order tidak ditemukan.'
            ], 404);
        }

        if ($order->status !== 'success') {
            $msg = $order->status === 'pending' ? 'Pembayaran masih pending.' : 'Pembayaran gagal/dibatalkan.';
            return response()->json([
                'success' => false,
                'message' => $msg
            ], 422);
        }

        if ($order->regisUlang) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta sudah melakukan registrasi ulang pada ' .
                    Carbon::parse($order->regisUlang->waktu)->format('H:i:s'),
                'ticket' => [
                    'name' => 'Sudah Masuk',
                    'category' => 'Terverifikasi',
                ]
            ], 422);
        }

        try {
            DB::beginTransaction();

            $regis = new RegisUlang();
            $regis->order_id = $order->id;
            $regis->gate_id = $request->gate_id;
            $regis->waktu = Carbon::now();
            $regis->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Registrasi ulang berhasil! Selamat datang.',
                'ticket' => [
                    'name' => $order->peserta->name,
                    'category' => "Event : " . $order->event->name,
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem saat menyimpan data.'
            ], 500);
        }
    }
}
