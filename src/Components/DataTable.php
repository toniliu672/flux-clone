<?php

declare(strict_types=1);

namespace FluxClone\Components\DataTable;

use Illuminate\View\Component;

class Index extends Component
{
    public function __construct(
        public ?string $searchPlaceholder = 'Search...',
        public bool $searchable = true,
        public bool $selectable = false,
        public bool $paginated = true,
        public int $perPage = 10,
        public array $perPageOptions = [10, 25, 50, 100],
        public ?string $emptyIcon = 'inbox',
        public ?string $emptyHeading = 'No data found',
        public ?string $emptyDescription = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.data-table.index');
    }
}
