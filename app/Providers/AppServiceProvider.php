<?php

namespace App\Providers;

use App\Contracts\CounterContract;
use App\Services\Counter;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\ActivityComposer;
use App\Services\DummyCounter;

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
        view()->composer(['posts.index', 'posts.show'], ActivityComposer::class);

        $this->app->singleton(Counter::class, function ($app) {
            return new Counter(
                $app->make('Illuminate\Contracts\Cache\Factory'),
                $app->make('Illuminate\Contracts\Session\Session'),
                env('COUNTER_TIMEOUT'));

        });

        $this->app->bind(CounterContract::class, Counter::class);
    }
}
