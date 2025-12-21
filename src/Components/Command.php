<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Command extends Component
{
    public function __construct(
        public ?string $placeholder = 'Type a command or search...',
    ) {}

    public function render()
    {
        return view('flux-clone::components.command');
    }
}
