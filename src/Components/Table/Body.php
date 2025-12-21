<?php

declare(strict_types=1);

namespace FluxClone\Components\Table;

use Illuminate\View\Component;

class Body extends Component
{
    public function __construct() {}

    public function render()
    {
        return view('flux-clone::components.table.body');
    }
}
