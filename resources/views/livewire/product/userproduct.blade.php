<div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold">My Product</h2>
                    <div class="row">
                        @foreach($products as $index=>$product)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('storage/images/'.$product->image) }}"
                                        alt="product" class="img-fluid"
                                        style="object-fit: contain;width:100%;height:200px"
                                        >
                                </div>
                                <div class="card-footer">
                                    <h6 class="text-center font-weight-bold">
                                        {{ $product->name }}
                                    </h6>
                                    <h6 class="text-left font-weight-bold">
                                       Harga : {{ $product->price }}
                                    </h6>
                                    <h6 class="text-left font-weight-bold">
                                       Stok : {{ $product->qty }}
                                    </h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{ url('/edit/product/'.$product->id) }}" class="btn btn-primary btn-block">Edit</a>
                                        </div>
                                        <div class="col-6">
                                            <button wire:click="delete({{$product->id}})" class="btn btn-danger btn-block">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
