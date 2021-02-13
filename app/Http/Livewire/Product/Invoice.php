<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
class Invoice extends Component
{
    public function render()
    {
        $transactions = Transaction::where('buyer', Auth::user()->name)->orderBy('created_at', 'DESC')->get();
        return view('livewire.product.invoice',[
            'transactions' => $transactions
        ]);
    }
}
