<?php

namespace App\Http\Livewire\Buyer;

use Livewire\Component;
use App\Models\User;

class Detail extends Component
{
    public $userid,$name, $role, $email, $password,$changedPass;
    public function mount($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->name = $user->name;
            $this->role = $user->role;
            $this->email = $user->email;
            $this->password = $user->password;
            $this->userid = $id;
        }
    }

    public function render()
    {
        return view('livewire.buyer.detail');
    }

    public function store(){
        $this->validate([
            'name'=>'required',
            'role' => 'required',
            'email' => 'required',
        ]);
        $this->changedPass = $this->changedPass?bcrypt($this->changedPass):$this->password;
        User::find($this->userid)->update([
            'name' => $this->name,
            'role' => $this->role,
            'email' => $this->email,
            'password'=>$this->changedPass,
        ]);

        return redirect()->to('/buyer');
    }
}
