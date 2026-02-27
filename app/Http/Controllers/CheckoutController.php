<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor_acc;
use App\Models\Barcode;

class CheckoutController extends Controller
{
    public function index()
    {
        $checkin = session(key: 'checkin_data');
        return view('check.out.index', compact('checkin'));
    }

    public function checkout(Request $request)
    {
        $kode = $request->kode;

        $checkin = Visitor_acc::where('barcode', $kode)
            ->first();

        if (!$checkin) {
            return back()->with('error', 'Barcode tidak ditemukan.');
        }

        // $barcode_out = Visitor_acc::where('visitor_accs.barcode', $kode)
        //     ->join('barcodes', 'visitor_accs.barcode_id', '=', 'barcodes.id')
        //     ->select('visitor_accs.barcode_id as barcode_id')
        //     ->first();

        // Barcode::select('id')->where('id', $barcode_out->barcode_id)->update(
        //     [
        //         'status' => 'tidak dipakai'
        //     ]
        // );

        $checkin->update([
                'check_out' => now(),
                'status' => 'checked_out',
                'barcode'=> null,
                'barcode_id' => null
            ]);


        // Redirect dengan data checkin via session flash
        return redirect()->route('check.out.index')->with('success', 'Data diterima: ' . $kode)->with('checkin_data', $checkin);
    }

}
