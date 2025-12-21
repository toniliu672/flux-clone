<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Profile extends Component
{
    public function __construct(
        public ?string $avatar = null,
        public ?string $name = null,
        public ?string $email = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.profile');
    }
}
