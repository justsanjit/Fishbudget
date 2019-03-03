<?php

namespace App\Http\Controllers;

use App\Import;

class TransactionImportController extends Controller
{
    public function create()
    {
        // If any import for user in progress redirect to mapping controller
        if (auth()->user()->imports()->inProgress()->count() > 0) {
            return redirect()->action('ImportMappingController@create');
        }

        return view('transactions.import.create');
    }

    public function store()
    {
        abort_if(auth()->user()->imports()->inProgress()->count() > 0, 429);

        // Validate user input
        request()->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        // Stores the file
        $file = request('file');
        $file->store('imports', ['disk' => 'local']);

        // Record import in database
        auth()->user()->imports()->create(['file' => $file->hashName(), 'status' => 'submitted']);

        return redirect()->route('transactions.import.mapping');
    }
}
