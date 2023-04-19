<?php

namespace App\View\Components;

use AvoRed\Framework\AvoRed\AvoRed;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use Illuminate\View\Component;

class AvoRedHeader extends Component
{
    public $categories;
    public function __construct()
    {
        $this->categories = AvoRed::repository(CategoryModelInterface::class)->all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.avored-header');
    }
}
