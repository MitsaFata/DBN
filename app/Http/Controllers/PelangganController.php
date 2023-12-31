<?php

namespace App\Http\Controllers;

use App\Imports\PelangganImport;
use App\Models\Bayar;
use App\Models\Layanan;
use App\Models\Laypel;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use function Laravel\Prompts\alert;

class PelangganController extends Controller
{
    //View Pelanggan
    public function index()
    {

        if (Auth::guard('mitra')->check()) {

            $mitra = Auth::guard('mitra')->user()->id_mitra;

            $pelanggan = Pelanggan::where('id_mitra', $mitra)->get();

            return view('Pelanggan.index', ['pelanggan' => $pelanggan, 'mitra' => $mitra]);
        } elseif (Auth::guard('admin')->check() || Auth::guard('staff')->check()) {

            $pelanggan = Pelanggan::get();
            return view('Pelanggan.index', ['pelanggan' => $pelanggan]);
        }
    }

    //View Pelanggan
    public function aktif()
    {

        if (Auth::guard('mitra')->check()) {
            $mitra = Auth::guard('mitra')->user()->id_mitra;

            $transaksi = Transaksi::join('laypels', 'transaksis.id_transaksi', '=', 'laypels.id_transaksi')
                ->join('bayars', 'laypels.id_laypel', '=', 'bayars.id_laypel')
                ->join('layanans', 'laypels.id_layanan', '=', 'layanans.id_layanan')
                ->join('pelanggans', 'laypels.id_pelanggan', '=', 'pelanggans.id_pelanggan')
                ->select('transaksis.*', 'pelanggans.*', 'layanans.nama_lay', 'laypels.id_laypel', 'bayars.*')
                ->where('pelanggans.id_mitra', '=', $mitra)
                ->distinct()
                ->get();

            $layanan = Layanan::where('id_mitra', $mitra)->where('statuslay', 1)->get();

            return view('Pelanggan.aktif', ['transaksi' => $transaksi, 'mitra' => $mitra, 'layanan' => $layanan]);
        } elseif (Auth::guard('admin')->check() || Auth::guard('staff')->check()) {

            $transaksi = Transaksi::join('laypels', 'transaksis.id_transaksi', '=', 'laypels.id_transaksi')
                ->join('layanans', 'laypels.id_layanan', '=', 'layanans.id_layanan')
                ->join('pelanggans', 'laypels.id_pelanggan', '=', 'pelanggans.id_pelanggan')
                ->select('transaksis.*', 'pelanggans.*', 'layanans.nama_lay', 'laypels.id_laypel')
                ->get();

            return view('Pelanggan.aktif', ['transaksi' => $transaksi]);
        }
    }

    //Form Add
    public function formadd()
    {
        return view('Pelanggan.tambah');
    }

    //Add Pelanggan
    public function add(Request $request)
    {
        $mitra = Auth::guard('mitra')->user()->id_mitra;

        $autoId = DB::table('pelanggans')->select(DB::raw('MAX(RIGHT(id_pelanggan,5)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%05s", $tmp);
            }
        } else {
            $kd = "00001";
        }

        $pel = new Pelanggan;
        $pel->id_pelanggan = ('PEL' . date('Y-m-d') . $kd);
        $pel->id_mitra = $mitra;
        $pel->nama_pel = $request->nama_pel;
        $pel->alamat = $request->alamat;
        $pel->no_telp = ("+62" . $request->no_telp);
        $pel->email = $request->email;
        $pel->nik = $request->nik;
        $pel->npwp = $request->npwp;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $maxSize = 2 * 1024 * 1024; // 2 MB dalam kilobyte
            if ($foto->getSize() > $maxSize) {
                return redirect()->back()->with('error', 'Ukuran file foto terlalu besar. Maksimum 2 MB.');
            }
            $filename = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('pelanggan'), $filename);
            $pel->foto = $filename;
        }

        $pel->statuspel = 1;
        $pel->save();

        //dd($pel);

        //View Alert
        return redirect('/mitra/pelanggan')->with('success', 'Pelanggan Baru Berhasil Ditambahkan');
    }

    //View Data Pelanggan Semua Mitra
    public function pelanggan($id_mitra)
    {
        $pelanggan = Pelanggan::where('id_mitra', $id_mitra)->get();

        return view('Pelanggan.mitra', ['pelanggan' => $pelanggan]);
    }

    //View Data Detail Pelanggan Setiap Mitra
    public function detail($id_pelanggan)
    {
        $pelanggan = Pelanggan::whereIdPelanggan($id_pelanggan)->first();
        return view('Pelanggan.detail', ['pelanggan' => $pelanggan]);
    }

    //View Edit
    public function show($id_pelanggan)
    {
        if (Auth::guard('mitra')->check()) {
            $mitra = Auth::guard('mitra')->user()->id_mitra;
            $pelanggan = Pelanggan::where('id_pelanggan', $id_pelanggan)->where('id_mitra', $mitra)->get();

            return view('Pelanggan.edit', ['pelanggan' => $pelanggan, 'mitra' => $mitra]);
        }
        //dd($id_pelanggan);
        $pelanggan = Pelanggan::where('id_pelanggan', $id_pelanggan)->get();
        return view('Pelanggan.edit', ['pelanggan' => $pelanggan]);
    }

    public function modal($id_pelanggan)
    {
        $pelanggan = Pelanggan::find($id_pelanggan);
        return response()->json([
            'status' => 200,
            'pelanggan' => $pelanggan
        ]);
    }

    public function viewlaypel($id_bayar)
    {

        $laypel = Bayar::join('laypels', 'laypels.id_laypel', '=', 'bayars.id_laypel')
            ->join('layanans', 'laypels.id_layanan', '=', 'layanans.id_layanan')
            ->where('id_bayar', $id_bayar)->first();
        return response()->json([
            'status' => 200,
            'laypel' => $laypel
        ]);
    }

    //Edit Pelanggan
    public function edit(Request $request, $id_pelanggan)
    {
        Pelanggan::where('id_pelanggan', $id_pelanggan)->update([
            'nama_pel' => $request->nama_pel,
            'alamat' => $request->alamat,
            'no_telp' => ("+62" . $request->no_telp),
            'email' => $request->email,
            'nik' => $request->nik,
            'npwp' => $request->npwp,
        ]);

        return redirect('/mitra/pelanggan')->with('success', 'Pelanggan Berhasil Diupdate');
    }

    //Status Pelanggan
    public function status($status, $id_pelanggan)
    {
        $model = Pelanggan::findOrFail($id_pelanggan);
        $model->statuspel = $status;

        //dd($model);
        if ($model->save()) {

            $notice = ['success' => 'Status Telah Diganti'];
        } else {
            $notice = ['error' => 'Status Gagal Diganti'];
        }

        return redirect()->back()->with($notice);
    }

    public function import(Request $request)
    {
        $request->validate([
            'import' => 'required|mimes:xlsx,csv',
        ]);

        try {
            Excel::import(new PelangganImport(), $request->file('import'));

            return redirect()->back()->with('success', 'Data pelanggan berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data pelanggan: ' . $e->getMessage());
        }
    }
}
