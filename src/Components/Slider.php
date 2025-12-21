<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Slider extends Component
{
    public function __construct(
        public int|float $min = 0,
        public int|float $max = 100,
        public int|float $step = 1,
        public int|float $value = 0,
        public bool $showValue = true,
    ) {}

    public function render()
    {
        return view('flux-clone::components.slider');
    }
}
