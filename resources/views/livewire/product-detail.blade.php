<div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">
                        
                        <p>{{$name}}</p>
                            @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                    </h2>
                        <div class="form-group">
                            @if($thumbnailImage)
                                <label class-"mt-2">Image Preview:</label>
                                <img src="{{ $thumbnailImage->temporaryUrl() }}" class="img-fluid" alt="Preview Image">
                            @else
                                <img src="{{ asset('storage/images/'.$image) }}"
                                        alt="product" class="img-fluid">
                            @endif
                        </div>
                        <div class="form-group">
                            <h4>Seller : </h4>
                        <p>{{$seller}}</p>
                            @error('seller')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h4>Deskripsi produk : </h4>
                        <p>{{$description}}</p>
                            @error('description')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h4>Stok</h4>
                        <p>{{$qty}}</p>
                            @error('qty')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h4>Harga</h4>
                        <p>{{$price}}</p>
                            @error('price')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        
                                    <button wire:click="addItem({{ $productId }})"
                                        class="btn btn-primary btn-sm btn-block">Add to cart</button>
                </div>
            </div>
        </div>
    </div>
</div>