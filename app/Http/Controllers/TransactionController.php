<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('client')->paginate(10);

        return Inertia::render('Transaction/TransactionsIndex', [
            'transactions' => $transactions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all(); // Get all clients to populate the dropdown
        return Inertia::render('Transaction/TransactionCreate', ['clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'transaction_date' => 'required|date',
            'amount' => 'required|numeric',
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {

        $transaction->load('client');

        return Inertia::render('Transaction/TransactionView', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $clients = Client::all(); // Get all clients to populate the dropdown
        return Inertia::render('Transaction/TransactionEdit', [
            'transaction' => $transaction,
            'clients' => $clients
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'transaction_date' => 'required|date',
            // Add other fields as necessary
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
