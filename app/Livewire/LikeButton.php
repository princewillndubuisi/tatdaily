<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\Auth;

class LikeButton extends Component
{
    #[Reactive]
    public Post $posts;

    public function toggleLike() {
        if(!Auth::check()) {
            return redirect()->route('login', true);
        }

        $user = Auth::user();

        if($user->hasLiked($this->posts)) {
            $user->likes()->detach($this->posts);
            return;
        }

        $user->likes()->attach($this->posts);
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
