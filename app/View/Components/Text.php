<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Text extends Component
{
    /**
     * The key name.
     *
     * @var string
     */
    public $key;

    /**
     * The data.
     *
     * @var array
     */
    public $value;

    /**
     * Create a new component instance.
     *
     * @param $key
     * @param $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('settings.components.text');
    }
}
