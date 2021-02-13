<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <h2 class="font-weight-bold">Cart List</h2>
                <table class="table">
                    <tbody>
                        @forelse($carts as $index=>$cart)
                            <tr class="align-self-center text-center">
                                <td class="align-middle text-left"> <img
                                        src="{{ asset('storage/images/'.$cart['image']) }}"
                                        alt="product" class="img-fluid" style="height:100px"></td>
                                <td class="align-middle">

                                    <a class="font-weight-bold"
                                        href="{{ url('/product/detail/'.substr($cart['rowId'],4,5)) }}">
                                        {{ $cart['name'] }}
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <button wire:click="increaseItem('{{ $cart['rowId'] }}')"
                                        class="btn btn-secondary btn-sm mx-3">+</button>
                                    {{ $cart['qty'] }}
                                    <button wire:click="decreaseItem('{{ $cart['rowId'] }}')"
                                        class="btn btn-secondary btn-sm mx-3">-</button></td>
                                <td class="align-middle">{{ $cart['price'] }}</td>
                                <td class="align-middle">
                                    <button wire:click="removeItem('{{ $cart['rowId'] }}')"
                                        class="btn btn-danger btn-sm">X</button></td>
                            </tr>
                        @empty
                            <td colspan="3">
                                <h6 class="text-center">Empty Cart</h6>
                            </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h4 class="font-weight-bold">Cart summary</h4>
                {{-- <h5 class="font-weight-bold">
                    Sub Total: {{ $summary['sub_total'] }}
                </h5>
                <h5 class="font-weight-bold">
                    Tax: {{ $summary['pajak'] }}
                </h5> --}}
                <div class="row">
                    <div class="col-6">
                        <h5>
                            Total:
                        </h5>
                    </div>
                    <div class="col-6">

                        <h5 class="font-weight-bold text-right">
                            {{ $summary['total'] }}
                        </h5>
                    </div>
                </div>
                {{-- <div>
                    <button wire:click="enableTax" class="btn btn-primary btn-block">Tambah Pajak</button>
                    <button wire:click="disableTax" class="btn btn-danger btn-block">Hapus Pajak</button>
                </div> --}}
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Alamat:</label>
                            <textarea wire:model="address" class="form-control" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
                                @error('address')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
            </div>
            <div class="card-footer">
                
                <div class="mt-3">
                        <button wire:click="submit" type="submit" class="btn btn-lg btn-success btn-block">Beli</button>

                </div>
            </div>
        </div>
    </div>
</div>
