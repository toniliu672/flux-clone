<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class OtpInput extends Component
{
    public function __construct(
        public int $length = 6,
        public string $type = 'text', // text, number
        public bool $autofocus = true,
    ) {}

    public function render()
    {
        return view('flux-clone::components.otp-input');
    }
}
