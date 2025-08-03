<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\AssetHelper;

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
        // Registrar helper de assets
        Blade::directive('assetCss', function ($asset) {
            return "<?php echo App\Helpers\AssetHelper::css($asset); ?>";
        });

        Blade::directive('assetJs', function ($asset) {
            return "<?php echo App\Helpers\AssetHelper::js($asset); ?>";
        });
    }
}
