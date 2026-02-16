<?php

namespace App\View\Components\utils;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $label;
    public $options;
    public $selectedValue;
    public $required;
    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        string $label,
        $options = null,
        $selectedValue = null,
        bool $required = false
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->selectedValue = $selectedValue;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.select');
    }
}
