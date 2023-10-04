<?php

namespace App\Providers;

use App\Models\Contract;
use App\Models\ContractStatus;
use App\Models\User;
use App\Observers\UserObserver;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() : void
    {
        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Model::preventLazyLoading(!app()->isProduction());
//        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());
        Model::unguard();
        Model::preventAccessingMissingAttributes(!app()->isProduction());

        User::observe(UserObserver::class);
    }
}
