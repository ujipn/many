<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Asset;
use App\Models\Transaction;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($calendar_id)
    {
        $calendar = Calendar::find($calendar_id);
        $asset = Asset::find($calendar->asset_id);
        $transaction = Transaction::where('calendar_id', $calendar_id)->first();

        return view('transactions.index', compact('asset', 'calendar','transaction'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $calendar_id)
    {
        $calendar = Calendar::find($calendar_id);
        $asset = Asset::find($calendar->asset_id);
    
        $transaction = new Transaction;
        $transaction->user_id = auth()->id();
        $transaction->calendar_id = $calendar->id;
        $transaction->asset_id = $asset->id;
        $transaction->status = 'pending';
        $transaction->save();
    
        return redirect()->route('transaction.index', ['calendar_id' => $calendar->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
