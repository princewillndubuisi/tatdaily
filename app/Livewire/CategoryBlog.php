<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;

class CategoryBlog extends Component
{
    #[Url()]
    public $CheckCategories = [];

    #[Computed()]
    public function category() {
        return Category::all();
    }

    public function SelectedCategories() {
        $this->dispatch('categoriesUpdate', $this->CheckCategories);
    }

    public function render()
    {
        return view('livewire.category-blog');
    }
}
