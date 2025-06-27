<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function transfers(Request $request)
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


        return view('transfer', compact('accounts', 'transactions'));
    }

    public function transfer(Request $request)
    {
        $data = $request->validate([
            'from_account_id' => 'required|different:to_account_id|exists:accounts,id',
            'to_account_id' => 'required|exists:accounts,id',
            'amount' => 'required|numeric|min:0.01',
            'note' => 'nullable|string',
            'scheduled_for' => 'nullable|date',
        ]);

        $from = Account::find($data['from_account_id']);
        $to = Account::find($data['to_account_id']);
        $amount = $data['amount'];
        $converted = $amount;

        $rate = $this->fxRate($from->currency, $to->currency);
        if ($rate === null) {
            return back()->with('error', 'FX rate not defined');
        }

        $converted = $from->currency === $to->currency ? $amount : $amount * $rate;

        if ($from->balance < $amount) {
            return back()->with('error', 'Insufficient balance');
        }

        DB::transaction(function () use ($from, $to, $amount, $converted, $data) {
            $from->decrement('balance', $amount);
            $to->increment('balance', $converted);

            Transaction::create([
                'from_account_id' => $from->id,
                'to_account_id' => $to->id,
                'amount' => $amount,
                'converted_amount' => $converted,
                'note' => $data['note'],
                'scheduled_for' => $data['scheduled_for'],
            ]);
        });

        return back()->with('success', 'Transfer completed!');
    }

    public function export()
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=transactions.csv",
        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['From', 'To', 'Amount', 'Converted', 'Note', 'Scheduled', 'Created']);

            foreach (Transaction::with('fromAccount', 'toAccount')->get() as $tx) {
                fputcsv($handle, [
                    $tx->fromAccount->name,
                    $tx->toAccount->name,
                    $tx->amount,
                    $tx->converted_amount,
                    $tx->note,
                    $tx->scheduled_for,
                    $tx->created_at,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function fxRate($from, $to)
    {
        $rates = [
            'USD' => ['KES' => 150, 'NGN' => 1400],
            'KES' => ['USD' => 1 / 150, 'NGN' => 1400 / 150],
            'NGN' => ['USD' => 1 / 1400, 'KES' => 150 / 1400],
        ];
        return $from === $to ? 1 : ($rates[$from][$to] ?? null);
    }
}
