<?php

namespace App\Http\Livewire\Buyer;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Userlist extends Component
{
    public $name, $role, $email, $password;
    public function render()
    {
        $checkuser = User::where([
            ['role', 'seller'],
            ['name', Auth::user()->name]
        ])->get();
        if (count($checkuser) == 1) {
            $users = User::orderBy('created_at', 'DESC')->get();
            return view('livewire.buyer.userlist', [
                'users' => $users
            ]);
        } else {

            return view('livewire.buyer.userlist', [
                'users' => []
            ]);
        }
    }
    public function redir()
    {

        return redirect()->route('product');
    }
    public function deleteUser($user)
    {
        $user = json_decode($user);
        $this->name = ($this->name) ? $this->name : $user->name;
        $this->role = ($this->role) ? $this->role : $user->role;
        $this->email = ($this->email) ? $this->email : $user->email;
        // $this->password = ($this->password) ? bcrypt($this->password) : $user->password;
        $user = User::find($user->id);
        $user = $user->delete();
        return redirect()->route('buyer');
    }
}
