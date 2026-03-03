<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $paymentNotPaied = Payment::where('user_id', auth()->user()->id)->whereNull('paid_at')->sum('amount');
        $paymentPaied = Payment::where('user_id', auth()->user()->id)->whereNotNull('paid_at')->sum('amount');
        return view('dashboard', [
            'colocation' => auth()->user()->activeColocation(),
            'paymentNotPaied' => $paymentNotPaied,
            'paymentPaied' => $paymentPaied,
        ]);
    }
}
