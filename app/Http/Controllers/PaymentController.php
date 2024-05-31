<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Payment;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\DataTables\PaymentDataTable;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaymentDataTable $paymentDataTable): JsonResponse | View
    {
        $tenants = Tenant::all();

        return $paymentDataTable->render('payment.index', compact('tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $storePaymentRequest): RedirectResponse
    {
        $tenant = Tenant::find($storePaymentRequest->tenant_id);

        $tenant->update([
            'balance' => $tenant->balance - $storePaymentRequest->amount
        ]);

        Payment::create($storePaymentRequest->validated());

        alert()->success('Payment Store Successfully!');

        return redirect()->route('payment.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment): JsonResponse | View
    {
        return response()->json($payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $updatePaymentRequest, Payment $payment): RedirectResponse
    {
        $payment->update($updatePaymentRequest->validated());

        alert()->success('Payment Updated Successfully!');

        return redirect()->route('payment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        $payment->delete();

        alert()->success('Payment Deleted Successfully!');

        return redirect()->route('payment.index');
    }
}
