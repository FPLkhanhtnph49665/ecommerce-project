<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

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
        Route::aliasMiddleware('admin', AdminMiddleware::class);
        // ----------------------------
        // Web client routes
        // ----------------------------
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        // ----------------------------
        // API routes
        // ----------------------------
        // Route::prefix('api')
        //     ->middleware('api')
        //     ->group(base_path('routes/api.php'));
    }
}
