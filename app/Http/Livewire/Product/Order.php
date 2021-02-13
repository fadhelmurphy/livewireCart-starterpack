<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class Order extends Component
{
    public function render()
    {
        $transactions = Transaction::where('seller', Auth::user()->name)->orderBy('created_at', 'DESC')->get();
        // dd($transactions);
        return view('livewire.product.order', [
            'transactions' => $transactions
        ]);
    }

    public function changeStatus($transaction){
        $transaction = json_decode($transaction);
        if ($transaction->status=="belum terkirim") {
            $transaction = Transaction::find($transaction->id);
            $transaction->update([
                'status'=>"terkirim"
            ]);
        }else {
            $transaction = Transaction::find($transaction->id);
            $transaction->update([
                'status' => "belum terkirim"
            ]);
        }
    }
}
