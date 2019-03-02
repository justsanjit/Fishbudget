<?php

namespace App\Http\Controllers;

use App\Import;

class TransactionImportController extends Controller
{
    public function create()
    {
        return view('transactions.import.create');
    }

    public function store()
    {
        request()->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        // Stores the file
        $file = request('file');
        $file->store('imports', ['disk' => 'local']);

        // Record import in database
        Import::create(['file' => $file->hashName()]);

        return redirect()->back()->with(['success' => 'Import submitted. It will take upto 10 minutes to process it.']);
    }
}
