<?php

namespace App\Providers;
use App\Complaint;
use App\House;

use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::share('unread', Complaint::where('read', 0)->count());
        View::share('pending', House::where('status', 'pending')->count());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
