<?php

declare(strict_types=1);

namespace FluxClone\Components\Breadcrumbs;

use Illuminate\View\Component;

class Item extends Component
{
    public function __construct(
        public ?string $href = null,
        public ?string $icon = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.breadcrumbs.item');
    }
}
