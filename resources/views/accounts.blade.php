@extends('layout')
@section('content')

    <div class="topbar">
        <h2>Accounts</h2>
            <div class="topbar-actions">
                <h2>Hello Admin</h2>
            </div>
    </div>
        <ul class="list-group mb-4">
            @foreach($accounts as $acc)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $acc->name }}</span>
                    <span>{{ $acc->currency }} {{ number_format($acc->balance, 2) }}</span>
                </li>
            @endforeach
        </ul>
@endsection