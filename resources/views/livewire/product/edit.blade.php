<div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">
                        Edit Product
                    </h2>
                    <form wire:submit.prevent="update">
                <input type="hidden" wire:model="productId">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input wire:model="name" type="text" class="form-control" />
                            @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Product Image</label>
                            <div class="custom-file">
                                <input wire:model="thumbnailImage" type="file" class="custom-file-input" id="customFile">
                                <label for="customFile" class="custom-file-label">Choose Image</label>

                                @error('thumbnailImage')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            @if($thumbnailImage)
                                <label class-"mt-2">Image Preview:</label>
                                <img src="{{ $thumbnailImage->temporaryUrl() }}" class="img-fluid" alt="Preview Image">
                            @else
                                <img src="{{ asset('storage/images/'.$image) }}"
                                        alt="product" class="img-fluid">
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea wire:model="description" type="text" class="form-control"></textarea>
                            @error('description')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Qty</label>
                            <input wire:model="qty" type="number" class="form-control" />
                            @error('qty')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input wire:model="price" type="number" class="form-control" />
                            @error('price')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>