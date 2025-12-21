<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Brand extends Component
{
    public function __construct(
        public ?string $href = '/',
        public ?string $logo = null,
        public ?string $name = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.brand');
    }
}
