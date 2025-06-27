@extends('layout')
@section('content')
    <div class="topbar">
        <h2>Dashboard</h2>
            <div class="topbar-actions">
                <h2>Hello Admin</h2>
            </div>
    </div>
    <div class="cards">
        <div class="row">
            <div class="col" style="background-color:#f3d3bd;">
                <h5>Accounts</h5>
                <h4>{{ $total_accounts }}</h4>
            </div>
            <div class="col" style="background-color:#9b6a6c;">
                <h5>Total Amount</h5>
                <h4>KES {{ $total_balance_kes}}</h4>
            </div>
            <div class="col" style="background-color:#2C0703;">
                <h5>Total Transactions</h5>
                <h4>{{ $transaction_count }}</h4>
            </div>
        </div>
    </div>
    <div class="accounts">
        <div class="row">
            <div class="col">
                <h4>Accounts</h4>
                <ul class="list-group mb-4">
                    @foreach($accounts as $acc)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $acc->name }}</span>
                            <span>{{ $acc->currency }} {{ number_format($acc->balance, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col">
                <h4>Transactions</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>From</th><th>To</th><th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $tx)
                            <tr>
                                <td>{{ $tx->fromAccount->name }}</td>
                                <td>{{ $tx->toAccount->name }}</td>
                                <td>{{ $tx->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection