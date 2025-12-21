<?php

declare(strict_types=1);

namespace FluxClone\Components\DataTable;

use Illuminate\View\Component;

class Row extends Component
{
    public function __construct(
        public mixed $id = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.data-table.row');
    }
}
