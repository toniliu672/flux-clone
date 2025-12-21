<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Link extends Component
{
    public function __construct(
        public ?string $href = null,
        public string $variant = 'default',
    ) {}

    public function render()
    {
        return view('flux-clone::components.link');
    }
}
