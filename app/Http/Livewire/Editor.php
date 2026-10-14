<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;


class Editor extends Component
{
    public function render()
    {
        $users = User::all();
        return view('livewire.editor', compact('users'));
    }
}
