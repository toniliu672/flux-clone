<?php

declare(strict_types=1);

namespace FluxClone\Components\DataTable;

use Illuminate\View\Component;

class Cell extends Component
{
    public function __construct(
        public ?string $align = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.data-table.cell');
    }
}
