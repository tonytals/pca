<?php

namespace ProntuarioEletronico\Providers;

use Illuminate\Support\ServiceProvider;
use Jenssegers\Date\Date;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
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
