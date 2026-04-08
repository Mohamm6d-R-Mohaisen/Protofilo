<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableAction extends Component
{
    public $id;
    public $resource;

    public function __construct($id, $resource)
    {
        $this->id = $id;
        $this->resource = $resource;
    }

    public function render()
    {
        return view('components.table-action');
    }
}
