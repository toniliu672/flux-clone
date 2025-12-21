<?php

declare(strict_types=1);

namespace FluxClone\Components\Tabs;

use Illuminate\View\Component;

class Panel extends Component
{
    public function __construct(
        public string $name,
    ) {}

    public function render()
    {
        return view('flux-clone::components.tabs.panel');
    }
}
