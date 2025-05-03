<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Advert;

class AdvertCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $adverts;

    public function __construct($adverts)
    {
        $this->adverts = $adverts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.advert-card');
    }
}
