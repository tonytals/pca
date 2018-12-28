<?php

namespace ProntuarioEletronico\Providers;

use Illuminate\Support\ServiceProvider;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Date::setLocale('pt-br');
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
