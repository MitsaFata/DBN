<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PurchaseOrderController extends Controller
{
    //View Purchase Order Mitra
    public function po()
    {
        $mitra = Auth::guard('mitra')->user()->id_mitra;
        return view('Purchase.purchaseorder', ['mitra' => $mitra]);
    }

    //Proses Purchase Order Mitra
    public function proses(Request $request)
    {
        $autoId = DB::table('purchase_orders')->select(DB::raw('MAX(RIGHT(id_purchase_order,4)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        $user = Auth::guard('mitra')->user()->id_mitra;

        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'spk' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'ba' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Get the uploaded image
        $spk = $request->file('spk');

        // Generate a unique file name for the spk
        $filespk = time() . '_' . uniqid() . '.' . $spk->getClientOriginalExtension();

        // Move the uploaded spk to the desired location
        $spk->move(('spks'), $filespk);

        // Get the uploaded image
        $ba = $request->file('ba');

        // Generate a unique file name for the ba
        $fileba = time() . '_' . uniqid() . '.' . $ba->getClientOriginalExtension();

        // Move the uploaded ba to the desired location
        $ba->move(('bas'), $fileba);

        // Jika validasi berhasil
        $po = new PurchaseOrder;
        $po->id_purchase_order = ('PO' . $kd);
        $po->id_mitra = $user;
        $po->tanggal = $request->tanggal;
        $po->spk = $filespk;
        $po->ba = $fileba;
        $po->status = 0;

        $po->save();

        return redirect('/mitra')->with('alert', 'Purchase Order Berhasil Dikirim');
    }

    //View Purchase Order Admin
    public function index()
    {
        $po = PurchaseOrder::where('status', '=', 0)->get();
        return view('Purchase.list', ['po' => $po]);
    }

    public function downloadspk($id_purchase_order)
    {
        $document = PurchaseOrder::where('id_purchase_order', $id_purchase_order)->first();
        $download = $document->spk;
        return response()->download(public_path('/spks/' . $download));
    }

    public function downloadba($id_purchase_order)
    {
        $document = PurchaseOrder::where('id_purchase_order', $id_purchase_order)->first();
        $download = $document->ba;
        return response()->download(public_path('/bas/' . $download));
    }

    //SPK
    public function spk(Request $request)
    {
        if (Auth::guard('mitra')->check()) {
            $mitra = Auth::guard('mitra')->user()->id_mitra;

            $po = DB::table('mitras')
                ->select('mitras.*')
                ->where('mitras.id_mitra', $mitra)
                ->first();

            $today = Carbon::now();

            $day = $today->dayName;
            $tanggal = $today->day; // Tanggal (hari)
            $bulan = $today->monthName;   // Bulan
            $tahun = $today->year;  // Tahun
            $jamSekarang = $today->format('H:i:s'); // Jam
            
            return view('Mitra.spk', ['mitra' => $mitra, 'po' => $po, 'day' => $day, 'tanggal' => $tanggal, 'bulan' => $bulan, 'tahun' => $tahun, 'jamSekarang' => $jamSekarang]);
        }

        $mitra = Mitra::where('id_mitra', '=', $request->id_mitra)->first();

        $today = Carbon::now();

        $day = $today->dayName;
        $tanggal = $today->day; // Tanggal (hari)
        $bulan = $today->monthName;   // Bulan
        $tahun = $today->year;  // Tahun

        return view('Mitra.spk', ['mitra' => $mitra, 'day' => $day, 'tanggal' => $tanggal, 'bulan' => $bulan, 'tahun' => $tahun]);
    }
}
