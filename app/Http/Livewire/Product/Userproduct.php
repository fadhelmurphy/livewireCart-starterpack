<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Auth;

class Userproduct extends Component
{
    public function render()
    {
        $products = ProductModel::where('seller', Auth::user()->name)->orderBy('created_at', 'DESC')->get();
        return view(
            'livewire.product.userproduct',
            [
                'products' => $products
            ]
        );
    }
    public function delete($id){
        $product = ProductModel::find($id);
        $product->delete();
    }
}
