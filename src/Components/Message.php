<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Message extends Component
{
    public function __construct(
        public string $variant = 'info',
    ) {}

    public function render()
    {
        return view('flux-clone::components.message');
    }
}
