<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\service_offers;
use App\Models\Feedback;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Retrieve all services from the database
        $services = service_offers::all();

        // Share the services variable with all views
        view()->share('services', $services);

        // Retrieve all feedback from the database
        $feedback = Feedback::all();

        // // Share the feedback variable with all views
        view()->share('feedback', $feedback);
    }
}
