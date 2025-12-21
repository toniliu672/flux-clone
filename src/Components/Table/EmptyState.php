<?php

declare(strict_types=1);

namespace FluxClone\Components\Table;

use Illuminate\View\Component;

class EmptyState extends Component
{
    public function __construct(
        public ?string $icon = 'inbox',
        public ?string $heading = 'No data',
        public ?string $description = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.table.empty-state');
    }
}
