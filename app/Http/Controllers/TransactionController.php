<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();

        return view('transactions.index', compact('transactions'));
    }

    public function store()
    {
        $attributes = request()->validate([
            'type' => 'required',
            'amount' => 'required|gt:1',
            'description' => 'required',
            'date' => 'required|date_format:Y-m-d'
        ]);

        Transaction::create(request(['description', 'date', 'type', 'amount']));

        return redirect('transactions');
    }
}
