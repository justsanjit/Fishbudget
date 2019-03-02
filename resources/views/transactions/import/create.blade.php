@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <h5 class="mb-4">Import Transactions</h5>
                    @if (session('success'))
                        <div class="alert alert-success" >
                            {{session('success')}}
                        </div>
                    @elseif ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{route('transactions.import')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <input type="file" accept=".csv" name="file" id="file">
                        </div>

                        <!-- <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="has_headers">
                            <label class="form-check-label" for="has_headers">File Contains Header</label>
                        </div> -->

                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection