<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $bindings = [
            \App\Contracts\TaxRepositoryInterface::class => \App\Repositories\EloquentTaxRepository::class,
            \App\Contracts\CategoryRepositoryInterface::class => \App\Repositories\EloquentCategoryRepository::class,
        ];

        foreach ($bindings as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
