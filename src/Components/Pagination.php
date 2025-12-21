<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Pagination extends Component
{
    public function __construct(
        public int $currentPage = 1,
        public int $lastPage = 1,
        public int $total = 0,
        public int $perPage = 10,
        public bool $simple = false,
    ) {}

    public function render()
    {
        return view('flux-clone::components.pagination');
    }
}
