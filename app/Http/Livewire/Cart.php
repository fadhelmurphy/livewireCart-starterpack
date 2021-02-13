<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product as ProductModel;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{
    public $tax = "0%",$address;

    public function render()
    {
        $products = ProductModel::orderBy('created_at', 'DESC')->get();

        // $condition = new \Darryldecode\Cart\CartCondition([
        //     'name'=>'pajak',
        //     'type'=>'tax',
        //     'target'=>'total',
        //     'value'=>$this->tax,
        // ]);

        // \Cart::session(Auth()->id())->condition($condition);
        $items = \Cart::session(Auth()->id())->getContent()->sortBy(function($cart){
            return $cart->attributes->get('added_at');
        });

        if(\Cart::isEmpty()){
            $cartData = [];
        }else{
            foreach ($items as $item) {
                $product = ProductModel:: findOrFail(substr($item->id, 4, 5));
                $cart[] = [
                    'rowId' => $item->id,
                    'image'=>$product->image,
                    'name' => $item->name,
                    'qty' => $item->quantity,
                    'pricesingle' => $item->price,
                    'price' => $item->getPriceSum(),
                ];
            }
            $cartData = collect($cart);
        }

        // $sub_total = \Cart::session(Auth()->id())->getSubTotal();
        $total = \Cart::session(Auth()->id())->getTotal();

        // $newCondition = \Cart::session(Auth()->id())->getCondition('pajak');
        // $pajak = $newCondition->getCalculatedValue($sub_total);

        $summary = [
            // 'sub_total' => $sub_total,
            // 'pajak' => $pajak,
            'total' => $total
        ];

        return view('livewire.cart',[
            'products' => $products,
            'carts' => $cartData,
            'summary' => $summary
        ]);
    }

    public function addItem($id){
        $rowId = "Cart".$id;
        $cart = \Cart::session(Auth()->id())->getContent();
        $cekItemId = $cart->whereIn('id',$rowId);

        if ($cekItemId->isNotEmpty()) {
            \Cart::session(Auth()->id())->update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => 1
                ]
            ]);
        }else{
            $product = ProductModel::findOrFail($id);
            \Cart::session(Auth()->id())->add([
                'id' => "Cart".$product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => [
                    'added_at' => Carbon::now()
                ]
            ]);
        }
    }
    // public function enableTax(){
    //     $this->tax = "+10%";
    // }
    // public function disableTax()
    // {
    //     $this->tax = "0%";
    // }

    public function increaseItem($id){
        $idProduct = substr($id,4,5);
        $product = ProductModel::find($idProduct);

        $cart = \Cart::session(Auth()->id())->getContent();
        $checkItem = $cart->whereIn('id',$id);

        if($product->qty == $checkItem[$id]->quantity){
            session()->flash('error','jumlah item lebih dari stok');
        }else{

        \Cart::session(Auth()->id())->update($id,[
            'quantity' => [
                'relative' => true,
                'value' => 1
            ]
        ]);
        }
    }
    public function decreaseItem($id){
        $cart = \Cart::session(Auth()->id())->getContent();
        $cekItemId = $cart->whereIn('id',$id);
        if($cekItemId[$id]->quantity>1){
        \Cart::session(Auth()->id())->update($id,[
            'quantity' => [
                'relative' => true,
                'value' => -1
            ]
        ]);
        }else{
            $this->removeItem($id);
        }
    }
    public function removeItem($id){
        \Cart::session(Auth()->id())->remove($id);
    }

    public function submit(){
        $this->validate(
            [
                'address'=>'required'
            ]
            );
        $carts = \Cart::session(Auth()->id())->getContent();
        $user = Auth::user()->name;
        $total = \Cart::session(Auth()->id())->getTotal();
        foreach ($carts as $index => $value) {
            // dd($value->getPriceSum());

            $idProduct = substr($value->id, 4, 5);
            $product = ProductModel::find($idProduct);
            Transaction::create([
                'tid'=>"tid". $total,
                'cartId' => $value->id,
                'buyer' => $user,
                'seller'=>$product->seller,
                'name' => $value->name,
                'address' => $this->address,
                'qty' => $value->quantity,
                'price' => $value->getPriceSum(),
                'sumTotal' => $total,
                'status' => "belum terkirim",
            ]);
            $product->update([
                'qty'   => ($product->qty-$value->quantity),
            ]);
            $this->removeItem($value->id);
        }

        session()->flash('info', 'Transaction success!');
        return redirect()->route('product');
    }
}
