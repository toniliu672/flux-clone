<?php

declare(strict_types=1);

namespace FluxClone\Components\DataTable;

use Illuminate\View\Component;

class Action extends Component
{
    public function __construct(
        public ?string $icon = null,
        public string $color = 'default',
        public ?string $tooltip = null,
        public ?string $href = null,
        public bool $confirm = false,
        public ?string $confirmMessage = 'Are you sure?',
    ) {}

    public function render()
    {
        return view('flux-clone::components.data-table.action');
    }
}
