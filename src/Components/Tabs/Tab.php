<?php

declare(strict_types=1);

namespace FluxClone\Components\Tabs;

use Illuminate\View\Component;

class Tab extends Component
{
    public function __construct(
        public string $name,
        public ?string $label = null,
        public ?string $icon = null,
        public bool $disabled = false,
    ) {
        $this->label ??= ucfirst($this->name);
    }

    public function render()
    {
        return view('flux-clone::components.tabs.tab');
    }
}
