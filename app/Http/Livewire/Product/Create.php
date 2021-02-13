<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    use WithFileUploads;
    public $name,$image,$description,$qty,$price,$user;
    public function render()
    {
        return view('livewire.product.create');
    }
    public function store(){
        
    $this->user = Auth::user()->name;
        $this->validate([
            'name'=>'required',
            'image' => 'image|max:2048|required',
            'description' => 'required',
            'qty' => 'required',
            'price' => 'required',
        ]);

        $imageName = md5($this->image.microtime().'.'.$this->image->extension());

        Storage::putFileAs(
            'public/images',
            $this->image,
            $imageName
        );

        ProductModel::create([
            'seller' => $this->user,
            'name'=>$this->name,
            'image'=>$imageName,
            'description'=>$this->description,
            'qty'=>$this->qty,
            'price'=>$this->price,
        ]);

        session()->flash('info','Product Created!!');
        return redirect()->route('product.list');
    }
}
