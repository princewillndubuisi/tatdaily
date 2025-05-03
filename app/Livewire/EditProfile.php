<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class EditProfile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $description;

    public function mount()
    {
        $this->loadUser();
    }

    public function loadUser()
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->description = $user->description;

    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'description' => 'required|max:1000',
        ]);

        $user = Auth::user();

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->description = $validatedData['description'];


        $user->save();

        return redirect()->route('profiles');
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
