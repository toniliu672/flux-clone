<?php

declare(strict_types=1);

namespace FluxClone\Components\Table;

use Illuminate\View\Component;

class Row extends Component
{
    public function __construct(
        public bool $header = false,
    ) {}

    public function render()
    {
        return view('flux-clone::components.table.row');
    }
}
