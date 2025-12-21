<?php

declare(strict_types=1);

namespace FluxClone\Components\DataTable;

use Illuminate\View\Component;

class Column extends Component
{
    public function __construct(
        public string $name,
        public ?string $label = null,
        public bool $sortable = false,
        public bool $searchable = false,
        public ?string $align = null,
        public ?string $width = null,
        public bool $hidden = false,
    ) {
        $this->label ??= ucfirst(str_replace('_', ' ', $this->name));
    }

    public function render()
    {
        return view('flux-clone::components.data-table.column');
    }
}
