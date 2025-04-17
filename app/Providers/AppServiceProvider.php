<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Exception;
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



        Schema::defaultStringLength(191);

        view()->share('website_name', 'Portfolio');
        try {
            $website = DB::table('website_settings')->first();
            view()->share('website', $website);
        } catch (Exception) {
        }
    }
}
