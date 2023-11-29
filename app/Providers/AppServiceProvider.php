<?php

namespace App\Providers;

use App\Modules\BestThoughts\Application\UseCases\AddBestThoughtCommand;
use App\Modules\BestThoughts\Application\UseCases\AddBestThoughtCommandInterface;
use App\Modules\BestThoughts\Application\UseCases\GetBestThoughtsCommand;
use App\Modules\BestThoughts\Application\UseCases\GetBestThoughtsCommandInterface;
use App\Modules\BestThoughts\Domain\BestThoughtRepositoryInterface;
use App\Modules\BestThoughts\Infrastructure\Repositories\BestThoughtRepository;
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
        $this->app->bind(BestThoughtRepositoryInterface::class, function(){
            return new BestThoughtRepository();
        });

        $this->app->bind(AddBestThoughtCommandInterface::class, function ($app){
            $bestThoughtRepository = app(BestThoughtRepositoryInterface::class);
            return new AddBestThoughtCommand($bestThoughtRepository);
        });

        $this->app->bind(GetBestThoughtsCommandInterface::class, function ($app){
            $bestThoughtRepository = app(BestThoughtRepositoryInterface::class);
            return new GetBestThoughtsCommand($bestThoughtRepository);
        });
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
