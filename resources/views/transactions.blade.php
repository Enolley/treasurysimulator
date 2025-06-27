@extends('layout')
@section('content')

    <div class="topbar">
        <h2>Transactions</h2>
            <div class="topbar-actions">
                <h2>Hello Admin</h2>
            </div>
    </div>


        <form method="GET" action="{{ url('/transactions') }}" class="row g-3 mb-3">
            <div class="col-md-3">
                <label>Filter by Account</label>
                <select name="account_id" class="form-select">
                    <option value="">-- All --</option>
                    @foreach($accounts as $acc)
                        <option value="{{ $acc->id }}" {{ request('account_id') == $acc->id ? 'selected' : '' }}>
                            {{ $acc->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Filter by Currency</label>
                <select name="currency" class="form-select">
                    <option value="">-- All --</option>
                    <option value="KES" {{ request('currency') == 'KES' ? 'selected' : '' }}>KES</option>
                    <option value="USD" {{ request('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                    <option value="NGN" {{ request('currency') == 'NGN' ? 'selected' : '' }}>NGN</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-outline-success">Apply Filters</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>From</th><th>To</th><th>Amount</th><th>Converted</th><th>Note</th><th>Scheduled</th><th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $tx)
                    <tr>
                        <td>{{ $tx->fromAccount->name }}</td>
                        <td>{{ $tx->toAccount->name }}</td>
                        <td>{{ $tx->amount }}</td>
                        <td>{{ $tx->converted_amount }}</td>
                        <td>{{ $tx->note }}</td>
                        <td>{{ $tx->scheduled_for }}</td>
                        <td>{{ $tx->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <div class="col-md-12 d-flex justify-content-end">
        <a href="{{ route('export') }}" class="btn btn-secondary">Export CSV</a>
    </div>
@endsection