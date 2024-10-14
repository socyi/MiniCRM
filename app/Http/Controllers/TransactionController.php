<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //index page for transactions with clients, paginated by 10
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

    //create page for transactions
    public function create()
    {
        $clients = Client::all();
        return Inertia::render('Transaction/TransactionCreate', ['clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     */

    //store the transaction
    public function store(StoreTransactionRequest $request)
    {
        Transaction::create($request->validated());
        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */

    //page that shows one transaction
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

    //edit page for one transaction
    public function edit(Transaction $transaction)
    {
        $clients = Client::all();
        return Inertia::render('Transaction/TransactionEdit', [
            'transaction' => $transaction,
            'clients' => $clients
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    //update the transaction
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    //delete the transaction
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
