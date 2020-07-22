<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap any application services.
    *
    * @return void
    */
    public function boot()
    {
        // JSON response wihtout data key
        JsonResource::withoutWrapping();

        // Localization
        setlocale(LC_TIME, env('APP_LC_TIME', 'es_BO.utf8'));
        Carbon::setLocale(env('APP_LOCALE', 'es'));

        // Custom validations
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        // Polymorphic relationships
        Relation::morphMap([
            'affiliates' => 'App\Affiliate',
            'spouses' => 'App\Spouse',
            'users' => 'App\User',
            'roles' => 'App\Role',
            'loans' => 'App\Loan',
            'procedure_types' => 'App\ProcedureType'
        ]);
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
