@extends('layout')
@section('content')
    <div class="container">
        <h2 class="mb-3">Treasury Simulator</h2>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <form method="POST" action="{{ route('transfer') }}" class="row g-3 mb-4">
            @csrf
            <div class="col-md-3">
                <label>From Account</label>
                <select name="from_account_id" class="form-select">
                    @foreach($accounts as $acc)
                        <option value="{{ $acc->id }}">{{ $acc->name }} ({{ $acc->currency }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>To Account</label>
                <select name="to_account_id" class="form-select">
                    @foreach($accounts as $acc)
                        <option value="{{ $acc->id }}">{{ $acc->name }} ({{ $acc->currency }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label>Amount</label>
                <input type="number" step="0.01" name="amount" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label>Note</label>
                <input type="text" name="note" class="form-control">
            </div>
            <div class="col-md-2">
                <label>Future Date</label>
                <input type="date" name="scheduled_for" class="form-control">
            </div>
            <div class="col-md-12">
                <button class="btn btn-success">Transfer</button>
            </div>
        </form>

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
</body>
</html>
@endsection