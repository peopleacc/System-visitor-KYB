<?php

namespace App\Http\Controllers;

use App\Models\Barcode;
use App\Models\Visitor_acc;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function index()
    {
        $checkin = session('checkin_data');
        return view('check.in.index', compact('checkin'));
    }

    public function checkin(Request $request)
    {
        $kode = $request->kode;

        $checkin = Visitor_acc::where('visitor_accs.barcode', $kode)
            ->with('barcode')
            // ->select(
            //     'visitor_accs.*',
            //     'barcodes.code as barcode_code',
            //     'barcodes.nama_barcode as barcode_nama',
            //     'barcodes.status as barcode_status'
            // )
            // ->get();
            ->first();

        if (!$checkin) {
            return back()->with('error', 'Barcode tidak ditemukan.');
        }

        $barcode_out = Barcode::orderBy('id', 'desc')->first();

        Visitor_acc::where('barcode', $kode)->update(
            [
                'check_in' => now(),
                'status' => 'checked_in',
                'barcode_id' => $barcode_out->id ?? null
            ]
        );

        barcode::where('id', $barcode_out->id)->update(
            [
                'status' => 'dipakai'

            ]
        );

        // Redirect dengan data checkin via session flash
        return redirect()->route('check.in.index')->with('success', 'Data diterima: ' . $kode)->with('checkin_data', $checkin);
    }
}
