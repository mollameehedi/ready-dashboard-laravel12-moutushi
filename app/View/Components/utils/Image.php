<?php

namespace App\View\Components\utils;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Image extends Component
{
    /**
     * The name of the input field.
     *
     * @var string
     */
    public $name;

    /**
     * The label for the input field.
     *
     * @var string
     */
    public $label;

    /**
     * The ID for the input field.
     *
     * @var string|null
     */
    public $id;

    /**
     * Whether the input field is required.
     *
     * @var bool
     */
    public $required;

    /**
     * An array of HTML attributes to apply to the input.
     *
     * @var array
     */
    public $attributes;

    /**
     * The current value of the input (for editing).
     *
     * @var string|null
     */
    public $value;

    /**
     * The text to display if no image is selected.
     *
     * @var string
     */
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @param  string  $name
     * @param  string  $label
     * @param  bool  $required
     * @param  array  $attributes
     * @param  string|null  $value
     * @param  string  $placeholder
     * @return void
     */
    public function __construct(
        string $name,
        string $label,
        bool $required = false,
        array $attributes = [],
        ?string $value = null,
        string $placeholder = 'Choose image'
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->id = $attributes['id'] ?? $name;
        $this->required = $required;
        $this->attributes = $attributes;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.image');
    }
}
