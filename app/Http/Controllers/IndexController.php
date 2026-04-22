<?php

namespace App\Http\Controllers;

use App\Mail\TicketMail;
use App\Models\Event;
use App\Models\Order;
use App\Models\Peserta;
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
        return view('front.index', compact('data'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'birthdate' => 'required',
            'event_id' => 'required'
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
                    'tanggal_lahir' => $request->birthdate,
                    'alamat' => 'NAN'
                ]);
                $peserta_id = $peserta->id;
            }

            $ticket = Event::findOrFail($request->event_id);

            $subtotal = $ticket->price * $request->qty;
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
                    ->margin(1)
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
        return view('front.success', compact('order'));
    }
}
