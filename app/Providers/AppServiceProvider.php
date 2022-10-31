<?php

namespace App\Providers;

use App\Models\Contract;
use App\Models\ContractStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

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
        Contract::query()->delete();
        ContractStatus::query()->delete();
        DB::table('contract_user')->delete();
        Model::preventLazyLoading(!app()->isProduction());
//        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());
        Model::unguard();
        Model::preventAccessingMissingAttributes(!app()->isProduction());
    }
}
