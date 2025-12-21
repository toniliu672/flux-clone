<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class FileUpload extends Component
{
    public function __construct(
        public bool $multiple = false,
        public ?string $accept = null,
        public ?int $maxSize = null, // in KB
    ) {}

    public function render()
    {
        return view('flux-clone::components.file-upload');
    }
}
