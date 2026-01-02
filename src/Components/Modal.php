<?php

declare(strict_types=1);

namespace FluxClone\Components\Modal;

use Illuminate\View\Component;

class Index extends Component
{
    public function __construct(
        public ?string $name = null,
        public string $size = 'md',
        public bool $closeable = true,
    ) {}

    public function render()
    {
        return view('flux-clone::components.modal.index');
    }
}
