<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // @content('key', 'Default text') — outputs editable site content
        // (admins are trusted, so the stored value is rendered as raw HTML).
        Blade::directive('content', function (string $expression) {
            return "<?php echo \App\Support\Content::get($expression); ?>";
        });
    }
}
