@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ClientID</th>
                                    <th>No.of Payment</th>
                                    <th>Frist Payment Date</th>
                                    <th>Last Payment Date</th>
                                    <th>Loan Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($loanDetails)
                                    @if($loanDetails)
                                        @foreach($loanDetails as $index=>$loan)
                                            <tr>
                                                <td>{{++$index}}</td>
                                                <td>{{$loan['client_id']}}</td>
                                                <td>{{$loan['num_of_payment']}}</td>
                                                <td>{{\Carbon\Carbon::parse($loan['first_payment_date'])->format('d M Y')}}</td>
                                                <td>{{\Carbon\Carbon::parse($loan['last_payment_date'])->format('d M Y')}}</td>
                                                <td>{{$loan['loan_amount']}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endisset
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
