<?php

namespace App\Http\Livewire\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Livewire\Component;

class Register extends Component
{
    public $form = [
        'name' => '',
        'email' => '',
        'role'=>'',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function submit()
    {
        $this->validate([
            'form.name' => 'required',
            'form.email' => 'required|email|unique:users,email',
            'form.role' => 'required',
            'form.password'              => 'required|confirmed',
            'form.password_confirmation' => 'required',
        ]);
        User::create([
            'name'=>$this->form['name'],
            'email' => $this->form['email'],
            'role' => $this->form['role'],
            'password' => bcrypt($this->form['password']),
        ]);
        return redirect()->route('login');

    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
