@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card p-4">
                    <h5 class="mb-4">Select import mappings</h5>
                    <form>
                        <table class="table">
                            <tr>
                                <th>Header 1</th>
                                <th>Header 2</th>
                                <th>Header 3</th>
                                <th>Header 4</th>
                            </tr>
                            <tr>
                                <td>R1C1</td>
                                <td>R1C2</td>
                                <td>R1C3</td>
                                <td>R1C4</td>
                            </tr>
                            <tr>
                                <td>R2C1</td>
                                <td>R2C2</td>
                                <td>R2C3</td>
                                <td>R2C4</td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="custom-select">
                                        <option>Field 1</option>
                                        <option>Field 2</option>
                                        <option>Field 3</option>
                                        <option>Field 4</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="custom-select">
                                        <option>Field 1</option>
                                        <option>Field 2</option>
                                        <option>Field 3</option>
                                        <option>Field 4</option>
                                    </select>
                                </td>
                                    <td>
                                    <select class="custom-select">
                                        <option>Field 1</option>
                                        <option>Field 2</option>
                                        <option>Field 3</option>
                                        <option>Field 4</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="custom-select">
                                        <option>Field 1</option>
                                        <option>Field 2</option>
                                        <option>Field 3</option>
                                        <option>Field 4</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <div class="text-right">
                            <button class="btn btn-secondary mr-2">Cancel</button>
                            <button class="btn btn-primary" type="submit">Start Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection