<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function index()
    {
        // TODO: Implement barcode listing
        return view('barcode.index');
    }

    public function store(Request $request)
    {
        // TODO: Implement barcode creation
    }

    public function destroy($id)
    {
        // TODO: Implement barcode deletion
    }
}
