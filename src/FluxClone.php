<?php

declare(strict_types=1);

namespace FluxClone;

use FluxClone\Support\ComponentClasses;

class FluxClone
{
    /**
     * Create a new ComponentClasses instance for class attribute merging.
     */
    public static function classes(string ...$classes): ComponentClasses
    {
        return new ComponentClasses(...$classes);
    }

    /**
     * Get custom styles if any.
     */
    public function styles(): string
    {
        return '';
    }

    /**
     * Get custom scripts if any.
     */
    public function scripts(): string
    {
        return '';
    }
}
