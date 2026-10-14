<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Addusertable extends Component
{
    public $name,$email,$password;
    

    public function adduser()
    {
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        return redirect()->route('users');
    }

    public function render()
    {
        return view('livewire.addusertable');
    }
}
