<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Perduoda app_name į visus Blade šablonus
        View::composer('*', function ($view) {
            $appName = 'Ticket Sistema';
            try {
                $appName = Setting::get('app_name', 'Ticket Sistema');
            } catch (\Exception $e) {
                // DB dar nepasiekiama
            }
            $view->with('appName', $appName);
        });
    }
}