<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class ContextMenu extends Component
{
    public function __construct() {}

    public function render()
    {
        return view('flux-clone::components.context-menu.index');
    }
}
