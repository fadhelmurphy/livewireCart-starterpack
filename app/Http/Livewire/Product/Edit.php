<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use WithFileUploads;
    public $productId,$name, $image, $description, $qty, $price, $user, $thumbnailImage;
    public function mount($id){
        $product = ProductModel::find($id);
        if($product){
            $this->productId = $product->id;
            $this->name = $product->name;
            $this->image = $product->image;
            $this->description = $product->description;
            $this->qty = $product->qty;
            $this->price = $product->price;
        }
    }
    public function store()
    {

        $this->user = Auth::user()->name;
        $this->validate([
            'name' => 'required',
            'image' => 'image|max:2048|required',
            'description' => 'required',
            'qty' => 'required',
            'price' => 'required',
        ]);

        $imageName = md5($this->image . microtime() . '.' . $this->image->extension());

        Storage::putFileAs(
            'public/images',
            $this->image,
            $imageName
        );

        ProductModel::create([
            'user' => $this->user,
            'name' => $this->name,
            'image' => $imageName,
            'description' => $this->description,
            'qty' => $this->qty,
            'price' => $this->price,
        ]);

        session()->flash('info', 'Product Created!!');

        $this->name = '';
        $this->image = '';
        $this->description = '';
        $this->qty = '';
        $this->price = '';
    }

    public function update()
    {
        // dd($this->productId);
        $this->user = Auth::user()->name;
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'qty' => 'required',
            'price' => 'required',
        ]);
            if($this->thumbnailImage){
            $imageName = md5($this->thumbnailImage . microtime() . '.' . $this->thumbnailImage->extension());

            Storage::putFileAs(
                'public/images',
                $this->thumbnailImage,
                $imageName
            );
            }else
            {
                $imageName=$this->image;
            }
        $product = ProductModel::find($this->productId);
        // dd($product);
        if ($product) {
            $product->update([
                'name'     => $this->name,
                'image'   => $imageName,
                'description'   => $this->description,
                'qty'   => $this->qty,
                'price'   => $this->price,
            ]);
        }

        //redirect
        return redirect()->route('product.list');
    }

    public function render()
    {
        return view('livewire.product.edit');
    }
}
