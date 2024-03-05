<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\service_offers;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Public folder name changed with public_html
        $this->app->bind('path.public', function () {
            return base_path() . '/public_html';
        });
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


        view()->share('feedback', $feedback);


        $weeklyServiceCounts = DB::table('schedule_lists')
            ->join('service_offers', 'schedule_lists.service', '=', 'service_offers.id')
            ->select(
                'service_offers.service_name',
                DB::raw('YEAR(schedule_date) as year'),
                DB::raw('WEEK(schedule_date, 1) as week'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('service_offers.service_name', 'year', 'week')
            ->orderBy('year', 'desc')
            ->orderBy('week', 'desc')
            ->get();

        view()->share('weeklyServiceCounts', $weeklyServiceCounts);
    }
}
