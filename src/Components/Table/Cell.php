<?php

declare(strict_types=1);

namespace FluxClone\Components\Table;

use Illuminate\View\Component;

class Cell extends Component
{
    public function __construct(
        public bool $header = false,
        public ?string $sortable = null,
        public ?string $align = null,
        public ?string $width = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.table.cell');
    }
}
