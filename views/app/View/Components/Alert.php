<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $info;
    public $message;
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($info = "info", $message = "Ciao", $name = "Nunzio")
    {
        $this->info = $info;
        $this->name = $name;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
