<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
    public function __construct(
        public bool $collapsible = true,
        public bool $collapsed = false,
    ) {}

    public function render()
    {
        return view('flux-clone::components.sidebar.index');
    }
}
