<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class PostComments extends Component
{
    use WithPagination;

    public Post $post;

    #[Rule('required|min:3|max:200')]
    public string $comment;

    #[Computed()]
    public function comments() {
        return $this?->post?->comments()->latest()->paginate(5);
    }

    public function postComment() {
        $this->validate();

        $user = Auth::user();

        $this->post->comments()->create([
            'comment' => $this->comment,
            'user_id' => $user->id,
        ]);

        $this->reset('comment');
    }

    public function render()
    {
        return view('livewire.post-comments', ['comments' => $this->comments,]);
    }
}
