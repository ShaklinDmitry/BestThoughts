<?php

namespace App\Providers;

use App\Modules\Pictures\Application\SaveImageCommand;
use App\Modules\Pictures\Application\SaveImageCommandInterface;
use App\Modules\Pictures\Domain\ImageRepositoryInterface;
use App\Modules\Pictures\Domain\ImageStorageInterface;
use App\Modules\Pictures\Infrastructure\Repositories\ImageRepository;
use App\Modules\Pictures\Infrastructure\Storage\ImageStorage;
use App\Modules\User\Application\Usecases\CreateUserTokenCommand;
use App\Modules\User\Application\Usecases\CreateUserTokenCommandInterface;
use App\Modules\User\Application\Usecases\RegisterUserCommand;
use App\Modules\User\Application\Usecases\RegisterUserCommandInterface;
use App\Modules\User\Infrastructure\Repositories\UserRepository;
use App\Modules\BestThoughts\Application\UseCases\AddBestThoughtCommand;
use App\Modules\BestThoughts\Application\UseCases\AddBestThoughtCommandInterface;
use App\Modules\BestThoughts\Application\UseCases\GetBestThoughtsCommand;
use App\Modules\BestThoughts\Application\UseCases\GetBestThoughtsCommandInterface;
use App\Modules\BestThoughts\Domain\BestThoughtRepositoryInterface;
use App\Modules\BestThoughts\Infrastructure\Repositories\BestThoughtRepository;
use App\Modules\User\Domain\UserRepositoryInterface;
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

        $this->app->bind(UserRepositoryInterface::class, function($app){
            return new UserRepository();
        });

        $this->app->bind(RegisterUserCommandInterface::class, function ($app){
            $userRepository = app(UserRepositoryInterface::class);
            return new RegisterUserCommand($userRepository);
        });

        $this->app->bind(CreateUserTokenCommandInterface::class, function ($app){
            $userRepository = app(UserRepositoryInterface::class);
            return new CreateUserTokenCommand($userRepository);
        });

        $this->app->bind(ImageRepositoryInterface::class, function ($app){
           return new ImageRepository();
        });

        $this->app->bind(ImageStorageInterface::class, function ($app){
            return new ImageStorage();
        });

        $this->app->bind(SaveImageCommandInterface::class, function ($app){
            return new SaveImageCommand(app(ImageRepositoryInterface::class), app(ImageStorageInterface::class));
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
