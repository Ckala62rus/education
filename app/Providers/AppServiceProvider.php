<?php

namespace App\Providers;

use App\Contracts\LessonRepositoryInterface;
use App\Contracts\LessonServiceInterface;
use App\Repositories\LessonRepository;
use App\Services\LessonService;
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
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
        $this->app->bind(LessonServiceInterface::class, LessonService::class);
        $this->app->bind(LessonRepositoryInterface::class, LessonRepository::class);
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
