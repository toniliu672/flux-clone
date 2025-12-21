<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Callout extends Component
{
    public function __construct(
        public string $type = 'info',
        public ?string $icon = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.callout');
    }
}
