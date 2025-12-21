<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Header extends Component
{
    public function __construct(
        public bool $sticky = true,
    ) {}

    public function render()
    {
        return view('flux-clone::components.header');
    }
}
