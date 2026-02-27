<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Models\Supplyer;
use App\Models\Contractor;
use App\Models\Barcode;
use App\Models\Visitor_acc;
use Illuminate\Support\Facades\Crypt as decryptString;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = Visitor::all();
        $supplyers = Supplyer::all();
        $contractors = Contractor::all();
        return view('visitor.index', compact('visitors', 'supplyers', 'contractors'));
    }

    public function show($id)
    {
        $visitor = Visitor::findOrFail($id);
        return view('visitor.show', compact('visitor'));
    }

    public function showSupply($id)
    {
        $supplyer = Supplyer::findOrFail($id);
        return view('visitor.show-supply', compact('supplyer'));
    }

    public function showContractor($id)
    {
        $contractor = Contractor::findOrFail($id);
        return view('visitor.show-contractor', compact('contractor'));
    }
}
