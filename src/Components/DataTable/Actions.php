<?php

declare(strict_types=1);

namespace FluxClone\Components\DataTable;

use Illuminate\View\Component;

class Actions extends Component
{
    public function __construct() {}

    public function render()
    {
        return view('flux-clone::components.data-table.actions');
    }
}
