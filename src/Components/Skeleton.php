<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Skeleton extends Component
{
    public function __construct(
        public string $variant = 'text',
    ) {}

    public function render()
    {
        return view('flux-clone::components.skeleton');
    }
}
