@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('loans.emi.details.create')}}" class="btn btn-sm btn-warning">Process Data</a>
                    </div>
                    <div class="card-body">
                        @if(count($emiDetails['header']) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Dates</th>
                                    <th>Payments</th>
                                </tr>

                                @isset($emiDetails['header'])
                                    @if($emiDetails['header'])

                                        @foreach($emiDetails['header'] as $header)
                                            @if($header != 'client_id' && $header != 'id')
                                                <tr>
                                                    <td>{{$header}}</td>
                                                    @foreach($emiDetails['tableBody'] as $body)
                                                        <td>{{$body[$header]}}</td>
                                                    @endforeach
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endisset

                            </table>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
