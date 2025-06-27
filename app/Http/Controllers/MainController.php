<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
   public function index()
    {
        $accounts = Account::all();
        $transaction_count = Transaction::count();
        $total_accounts = Account::count();
        $total_balance = Account::sum('balance');
        $transactions = Transaction::all();


        $fxRates = [
            'USD' => 150,
            'NGN' => 0.107,  
            'KES' => 1
        ];

        $balancesByCurrency = Account::select('currency', DB::raw('SUM(balance) as total'))
            ->groupBy('currency')
            ->get();

        $total_balance_kes = 0;
        foreach ($balancesByCurrency as $row) {
            $rate = $fxRates[$row->currency] ?? 1;
            $total_balance_kes += $row->total * $rate;
        }

        return view('dashboard', compact(
            'accounts',
            'transactions',
            'total_accounts',
            'total_balance',
            'total_balance_kes',
            'transaction_count'
        ));
    }


    public function accounts()
    {
        $accounts = Account::all();

        return view('accounts', compact('accounts'));
    }

    public function transactions(Request $request)
    {
        $accounts = Account::all();
        $transactions = Transaction::with('fromAccount', 'toAccount')
            ->when($request->account_id, fn($q) =>
                $q->where('from_account_id', $request->account_id)->orWhere('to_account_id', $request->account_id)
            )
            ->when($request->currency, fn($q) =>
                $q->whereHas('fromAccount', fn($q2) => $q2->where('currency', $request->currency))
            )
            ->orderBy('created_at', 'desc')
            ->get();


        return view('transactions', compact('accounts', 'transactions'));
    
    }
}
