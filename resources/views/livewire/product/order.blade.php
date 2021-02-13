<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">

                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <h2 class="font-weight-bold">Order List</h2>
                <table class="table">
                    <tbody>
                        @forelse($transactions as $index=>$transaction)
                            <tr class="align-self-center text-left">
                                <td class="align-middle">
                                    
                                    <a class="font-weight-bold" href="{{url('/product/detail/'.substr($transaction['cartId'],4,5))}}">
                                            {{ $transaction['name'] }}
                                        </a>
                                </td>
                                <td class="align-middle">
                                    {{ $transaction['qty'] }}
                                </td>
                                <td class="align-middle">{{ $transaction['price'] }}</td>
                                <td class="align-middle">{{ $transaction['address'] }}</td>
                                <td class="align-middle">{{ $transaction['status'] }}</td>
                                <td>
                                <button wire:click="changeStatus('{{$transaction}}')" class="btn btn-primary btn-block">Change status</button></td>
                            </tr>
                        @empty
                            <td colspan="3">
                                <h6 class="text-center">Empty Order</h6>
                            </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
