<?php

namespace App\Http\Controllers;

use App\Models\Fundraising;
use Illuminate\Http\Request;
use App\Models\FundraisingWithDrawal;
use App\Http\Requests\StoreFundraisingWithdrawalRequest;
use App\Http\Requests\UpdateFundraisingWithdrawalRequest;

class FundraisingWithDrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fundraising_withdrawals = FundraisingWithDrawal::orderByDesc('id')->get();

        return view('admin.fundraising_withdrawals.index', compact('fundraising_withdrawals'));
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
    public function store(StoreFundraisingWithdrawalRequest $request, Fundraising $fundraising)
    {
        $hasRequestedWithdrawal = $fundraising->withdrawals()->exists();

        if ($hasRequestedWithdrawal) {
            return redirect()->route('admin.fundraisings.show', $fundraising);
        }

        DB::transaction(function () use ($request, $fundraising) {

            $validated = $request->validated();
            
            $validated['fundraising_id'] = Auth::user()->fundraiser->id;
            $validated['has_received'] = false;
            $validated['has_sent'] = false;
            $validated['amount_requested'] = $fundraising->totalReachedAmount();
            $validated['amount_received'] = 0;
            $validated['proof'] = "images/proof-default.png";

            $fundraising->withdrawals()->create($validated);
        });

        return redirect()->route('admin.my-withdrawals');
    }

    /**
     * Display the specified resource.
     */
    public function show(FundraisingWithDrawal $fundraisingWithDrawal)
    {
        return view('admin.fundraising_withdrawals.show', compact('fundraisingWithDrawal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FundraisingWithDrawal $fundraisingWithDrawal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FundraisingWithDrawal $fundraisingWithDrawal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UpdateFundraisingWithdrawalRequest $request, FundraisingWithDrawal $fundraisingWithDrawal)
    {
        DB::transaction(function () use ($request, $fundraisingWithDrawal) {
            
            $validated = $request->validated();

            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $validated['has_sent'] = 1;

            $fundraisingWithDrawal->update($validated);

        });

        return redirect()->route('admin.fundraising_withdrawals.show', $fundraisingWithDrawal);
    }
}