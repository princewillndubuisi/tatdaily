<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class PostBlog extends Component
{
    use WithPagination;


    #[Url()]
    public $CheckCategories = [];

    #[Url()]
    public $search = '';

    #[Computed()]
    public function post() {
        return Post::where('post_status', '=', 'active')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', "%{$this->search}%");
            })
            ->when(!empty($this->CheckCategories), function ($query) {
                $query->whereIn('category_id', $this->CheckCategories);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(3);
    }


    #[On('search')]
    public function updateSearch($search) {
        $this->search = $search;
        $this->resetPage();

        // Force refresh if the input is cleared
        if (trim($search) === '') {
            $this->dispatch('$refresh');
        }
    }


    #[On('categoriesUpdate')]
    public function updatedCategories($CheckCategories) {
        $this->CheckCategories = $CheckCategories;
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.post-blog');
    }
}
