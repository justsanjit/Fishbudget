<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()->transactions()
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(100);

        return view('transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        abort_if(auth()->user()->isNot($transaction->user), 403);

        return view('transactions.show', compact('transaction'));
    }

    public function store()
    {
        $attributes = request()->validate([
            'type' => 'required',
            'amount' => 'required|gt:1',
            'description' => 'required',
            'date' => 'required|date_format:Y-m-d',
        ]);

        auth()->user()->transactions()->create($attributes);

        return redirect('transactions');
    }
}
