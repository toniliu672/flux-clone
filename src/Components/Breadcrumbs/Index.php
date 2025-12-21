<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public function __construct(
        public ?string $separator = null, // null = chevron, '/' = slash
    ) {}

    public function render()
    {
        return view('flux-clone::components.breadcrumbs.index');
    }
}
