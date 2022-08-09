<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class DeleteModal extends Component
{
    
    public $route;
    public $id;

    public function __construct($route, $id)
    {
        $this->route = $route;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.delete-modal');
    }
}
