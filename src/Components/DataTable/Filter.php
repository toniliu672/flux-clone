<?php

declare(strict_types=1);

namespace FluxClone\Components\DataTable;

use Illuminate\View\Component;

class Filter extends Component
{
    public function __construct(
        public string $name,
        public ?string $label = null,
        public string $type = 'select', // select, date, daterange, boolean
        public array $options = [],
    ) {
        $this->label ??= ucfirst(str_replace('_', ' ', $this->name));
    }

    public function render()
    {
        return view('flux-clone::components.data-table.filter');
    }
}
