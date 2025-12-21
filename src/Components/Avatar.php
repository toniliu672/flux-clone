<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Avatar extends Component
{
    public function __construct(
        public ?string $src = null,
        public ?string $alt = null,
        public string $size = 'base',
        public ?string $name = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.avatar');
    }

    public function initials(): string
    {
        if (! $this->name) {
            return '?';
        }

        $words = explode(' ', $this->name);
        $initials = '';

        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return $initials;
    }
}
