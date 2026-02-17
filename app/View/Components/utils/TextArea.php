<?php

namespace App\View\Components\utils;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextArea extends Component
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
     * The initial value of the textarea.
     *
     * @var string|null
     */
    public $value;

    /**
     * Whether the textarea is required.
     *
     * @var bool
     */
    public $required;

    /**
     * An array of HTML attributes to apply to the textarea.
     *
     * @var array
     */
    public $attributes;

    /**
     * The number of rows for the textarea.
     *
     * @var int
     */
    public $rows;

    /**
     * Create a new component instance.
     *
     * @param  string  $name
     * @param  string  $label
     * @param  string|null  $value
     * @param  bool  $required
     * @param  array  $attributes
     * @param  int  $rows
     * @return void
     */
    public function __construct(
        string $name,
        string $label,
        ?string $value = null,
        bool $required = false,
        array $attributes = [],
        int $rows = 3
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->required = $required;
        $this->attributes = $attributes;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.text-area');
    }
}
