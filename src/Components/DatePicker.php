<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class DatePicker extends Component
{
    public function __construct(
        public ?string $value = null,
        public ?string $placeholder = 'Select date',
        public ?string $format = 'Y-m-d',
    ) {}

    public function render()
    {
        return view('flux-clone::components.date-picker');
    }
}
