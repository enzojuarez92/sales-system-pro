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
            \App\Contracts\ProductRepositoryInterface::class => \App\Repositories\EloquentProductRepository::class,
            \App\Contracts\TaxConditionRepositoryInterface::class => \App\Repositories\EloquentTaxConditionRepository::class,
            \App\Contracts\ContactRepositoryInterface::class => \App\Repositories\EloquentContactRepository::class,
            \App\Contracts\InventoryMovementRepositoryInterface::class => \App\Repositories\EloquentInventoryMovementRepository::class,
            \App\Contracts\PurchaseRepositoryInterface::class => \App\Repositories\EloquentPurchaseRepository::class,
            \App\Contracts\PurchaseItemRepositoryInterface::class => \App\Repositories\EloquentPurchaseItemRepository::class,
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
