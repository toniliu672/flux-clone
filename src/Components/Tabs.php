<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Tabs extends Component
{
    public function __construct(
        public string $variant = 'default', // default, pills, underline
        public ?string $defaultTab = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.tabs.index');
    }
}
