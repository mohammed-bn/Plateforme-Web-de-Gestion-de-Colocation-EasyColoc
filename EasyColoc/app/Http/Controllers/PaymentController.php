<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function markAsPaid(Payment $payment)
    {
        if ($payment->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Vous ne pouvez marquer que vos propres paiements comme payés.');
        }

        $payment->update([
            'paid_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Paiement marqué comme payé.');
    }
}
