<?php

declare(strict_types=1);

namespace FluxClone\Components\Navlist;

use Illuminate\View\Component;

class Item extends Component
{
    public function __construct(
        public ?string $href = null,
        public ?string $icon = null,
        public bool $active = false,
    ) {}

    public function render()
    {
        return view('flux-clone::components.navlist.item');
    }

    public function isActive(): bool
    {
        if ($this->active) {
            return true;
        }

        if ($this->href && request()->url() === url($this->href)) {
            return true;
        }

        return false;
    }
}
