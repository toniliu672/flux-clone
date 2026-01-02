<?php

declare(strict_types=1);

namespace FluxClone\Support;

use Stringable;

/**
 * Helper class for building and merging CSS class strings.
 * Similar to Flux's class helper for consistent component styling.
 */
class ComponentClasses implements Stringable
{
    protected array $classes = [];

    public function __construct(string ...$classes)
    {
        $this->classes = array_filter($classes);
    }

    /**
     * Add classes to the collection.
     */
    public function add(string|array|null $classes): static
    {
        if ($classes === null) {
            return $this;
        }

        if (is_string($classes)) {
            $classes = explode(' ', $classes);
        }

        $this->classes = array_merge($this->classes, array_filter($classes));

        return $this;
    }

    /**
     * Conditionally add classes.
     */
    public function when(bool $condition, string|array $classes, string|array|null $default = null): static
    {
        if ($condition) {
            $this->add($classes);
        } elseif ($default) {
            $this->add($default);
        }

        return $this;
    }

    /**
     * Conditionally add classes when condition is false.
     */
    public function unless(bool $condition, string|array $classes): static
    {
        return $this->when(! $condition, $classes);
    }

    /**
     * Convert the classes to a string.
     */
    public function __toString(): string
    {
        return implode(' ', array_unique($this->classes));
    }

    /**
     * Get the classes as an array.
     */
    public function toArray(): array
    {
        return array_unique($this->classes);
    }
}
