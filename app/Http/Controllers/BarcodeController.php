<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barcode;
class BarcodeController extends Controller
{
    public function index()
    {
        $barcode = Barcode::all();
        return view("barcode.index", compact('barcode'));
    }

    public function store(Request $request)
    {
        $last = Barcode::latest()->first();
        $no = $last ? ((int) str_replace('ID-CARD-', '', $last->nama_id)) + 1 : 1;

        $nama_id = "ID-CARD-" . $no;

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        Barcode::create([
            'code' => $otp,
            'status' => 'tidak dipakai',
            'nama_barcode' => $nama_id,
        ]);

        return redirect()->route('barcode.index')->with('success', 'berhasil menambahkan barcode');
    }

    public function destroy($id)
    {
        $barcode = Barcode::findOrFail($id);
        $barcode->delete();

        return redirect()->route('barcode.index')->with('success', 'Barcode berhasil dihapus');
    }
}
