@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col">
                <h4>Transactions</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>amount</th>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{$transaction->date}}</td>
                                <td>{{$transaction->description}}</td>
                                <td>{{$transaction->type}}</td>
                                <td>{{$transaction->amount}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mx-auto">
                    {{$transactions->links()}}
                </div>
            </div>
        </div>  
    </div>
@endsection