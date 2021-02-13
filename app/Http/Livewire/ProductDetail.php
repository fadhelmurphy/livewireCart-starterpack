<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductDetail extends Component
{
    use WithFileUploads;
    public $productId, $name, $image, $description, $qty, $price, $user, $thumbnailImage,$seller;
    public function mount($id)
    {
        $product = ProductModel::find($id);
        if ($product) {
            $this->productId = $product->id;
            $this->name = $product->name;
            $this->image = $product->image;
            $this->description = $product->description;
            $this->qty = $product->qty;
            $this->price = $product->price;
            $this->seller = $product->seller;
        }
    }

    public function addItem($id)
    {
        if (Auth::check()) {
            $product = ProductModel::findOrFail($id);
            // dd($product->qty);
            $rowId = "Cart" . $id;
            $cart = \Cart::session(Auth()->id())->getContent();
            $cekItemId = $cart->whereIn('id', $rowId);

            if ($cekItemId->isNotEmpty()) {
                if ($product->qty == $cekItemId[$rowId]->quantity) {
                    session()->flash('error', 'jumlah item kurang');
                } else {
                    \Cart::session(Auth()->id())->update($rowId, [
                        'quantity' => [
                            'relative' => true,
                            'value' => 1
                        ]
                    ]);
                }
            } else {
                $product = ProductModel::findOrFail($id);
                \Cart::session(Auth()->id())->add([
                    'id' => "Cart" . $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'attributes' => [
                        'added_at' => Carbon::now()
                    ]
                ]);
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.product-detail');
    }
}
