<?php

namespace App\Providers;

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
        $this->app->bind(
            'App\Repositories\Contracts\PessoaRepositoryInterface',
            'App\Repositories\Eloquent\PessoaRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\CarroRepositoryInterface',
            'App\Repositories\Eloquent\CarroRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
