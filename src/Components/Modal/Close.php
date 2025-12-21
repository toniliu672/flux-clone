<?php

declare(strict_types=1);

namespace FluxClone\Components\Modal;

use Illuminate\View\Component;

class Close extends Component
{
    public function __construct() {}

    public function render()
    {
        return view('flux-clone::components.modal.close');
    }
}
