<?php

declare(strict_types=1);

namespace FluxClone\Components\Table;

use Illuminate\View\Component;

class Index extends Component
{
    public function __construct(
        public bool $striped = false,
        public bool $hoverable = true,
        public bool $bordered = false,
        public bool $compact = false,
        public bool $loading = false,
        public ?string $sortBy = null,
        public string $sortDirection = 'asc',
    ) {}

    public function render()
    {
        return view('flux-clone::components.table.index');
    }
}
