<div>
    <div class="row">
        <div class="col-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold">Product List</h2>
                    @if(session()->has('info'))
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                    @endif
                    <div class="row">
                        @foreach($products as $index=>$product)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <a
                                            href="{{ url('/product/detail/'.$product->id) }}">
                                        <img src="{{ asset('storage/images/'.$product->image) }}"
                                            alt="product" style="object-fit: contain;width:100%;height:200px">
                                        </a>
                                    </div>
                                    <div class="card-footer">
                                        <a
                                            href="{{ url('/product/detail/'.$product->id) }}">
                                            <h5 class="text-success font-weight-bold">
                                                {{ $product->name }}
                                            </h5>
                                        </a>
                                        <h6 class="text-left font-weight-bold">
                                            Seller : {{ $product->seller }}
                                        </h6>
                                        <h6 class="text-left font-weight-bold">
                                            Harga : {{ $product->price }}
                                        </h6>
                                        <h6 class="text-left font-weight-bold">
                                            Stok :
                                            {{ ($product->qty==0)?'habis':$product->qty }}
                                        </h6>
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
