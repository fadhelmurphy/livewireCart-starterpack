<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">

                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <h2 class="font-weight-bold">Users List</h2>
                <table class="table">
                    <tbody>
                        @forelse($users as $index=>$user)
                            <tr class="align-self-center text-left">
                                <td class="align-middle">
                                    {{ $user['name'] }}
                                </td>
                                <td class="align-middle">
                        {{ $user['role'] }}
                        </td>
                                <td class="align-middle">{{ $user['email'] }}</td>
                                <td class="align-middle">{{ $user['password'] }}</td>
                                <td class="align-middle">
                                    
                                <a href="{{url('/buyer/'.$user['id'])}}" class="btn btn-primary btn-block btn-sm">Change</a></td>
                                {{-- <button wire:click="editUser('{{$user}}')" class="btn btn-primary btn-block btn-sm">Change</button></td> --}}
                                <td class="align-middle">
                                <button wire:click="deleteUser('{{$user}}')" class="btn btn-danger btn-block btn-sm">Delete</button></td>
                            </tr>
                        @empty
                            <td colspan="3">
                                <h6 class="text-center">Empty User</h6>
                                
                                <a wire:click="redir" class="btn btn-success btn-block btn-lg mx-auto">Back to home</a></td>
                            </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
