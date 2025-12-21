<?php

declare(strict_types=1);

namespace FluxClone;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class FluxCloneServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('flux-clone', function () {
            return new FluxClone();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerComponents();
        $this->registerViews();
        $this->registerPublishing();
        $this->registerBladeDirectives();
    }

    /**
     * Register the Blade components.
     */
    protected function registerComponents(): void
    {
        // Auto-discover components from the Components directory
        $componentNamespace = 'FluxClone\\Components';
        $componentPath = __DIR__ . '/Components';

        if (is_dir($componentPath)) {
            $this->loadComponentsFrom($componentPath, $componentNamespace);
        }
    }

    /**
     * Load components from a directory.
     */
    protected function loadComponentsFrom(string $path, string $namespace, string $prefix = ''): void
    {
        $files = glob($path . '/*.php');

        foreach ($files as $file) {
            $componentName = basename($file, '.php');
            $componentClass = $namespace . '\\' . $componentName;

            if (class_exists($componentClass)) {
                $alias = $prefix ? $prefix . '.' . $this->kebab($componentName) : $this->kebab($componentName);
                Blade::component($componentClass, $alias, 'flux-clone');
            }
        }

        // Handle subdirectories for nested components (e.g., modal.trigger)
        $directories = glob($path . '/*', GLOB_ONLYDIR);

        foreach ($directories as $directory) {
            $dirName = basename($directory);
            $newPrefix = $prefix ? $prefix . '.' . $this->kebab($dirName) : $this->kebab($dirName);
            $newNamespace = $namespace . '\\' . $dirName;

            $this->loadComponentsFrom($directory, $newNamespace, $newPrefix);
        }
    }

    /**
     * Register the package views.
     */
    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'flux-clone');
    }

    /**
     * Register the publishable resources.
     */
    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            // Publish views
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/flux-clone'),
            ], 'flux-clone-views');
        }
    }

    /**
     * Register custom Blade directives.
     */
    protected function registerBladeDirectives(): void
    {
        // @fluxCloneStyles - for any custom CSS
        Blade::directive('fluxCloneStyles', function () {
            return '<?php echo app("flux-clone")->styles(); ?>';
        });

        // @fluxCloneScripts - for any custom JS
        Blade::directive('fluxCloneScripts', function () {
            return '<?php echo app("flux-clone")->scripts(); ?>';
        });
    }

    /**
     * Convert a string to kebab-case.
     */
    protected function kebab(string $value): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $value));
    }
}
