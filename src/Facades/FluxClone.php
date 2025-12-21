<?php

declare(strict_types=1);

namespace FluxClone\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \FluxClone\FluxClone
 *
 * @method static \FluxClone\Support\ComponentClasses classes(string ...$classes)
 */
class FluxClone extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'flux-clone';
    }
}
