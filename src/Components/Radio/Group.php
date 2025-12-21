<?php

declare(strict_types=1);

namespace FluxClone\Components\Radio;

use Illuminate\View\Component;

class Group extends Component
{
    public function __construct(
        public string $variant = 'default',
        public ?string $name = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.radio.group');
    }
}
