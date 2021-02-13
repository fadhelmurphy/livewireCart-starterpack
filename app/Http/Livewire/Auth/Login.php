<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends Component
{

    public $form = [
        'email' => '',
        'password' => ''
    ];

    public function submit(){
        // dd($this->form);
        $this->validate([
            'form.email'=>'required|email',
            'form.password'=>'required'
        ]);
        $user = User::where([
            "email"=>$this->form["email"]
        ])->get();

        if (count($user)==1&&Auth::attempt($this->form)) {
            return redirect()->route('product');
        }else{
            session()->flash('error','Username dan password salah silahkan coba lagi');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
