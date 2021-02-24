<?php

namespace App\Providers;

use App\Services\BeerManager;
use App\Services\BeerManagerInterface;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(BeerManagerInterface::class, BeerManager::class);
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
