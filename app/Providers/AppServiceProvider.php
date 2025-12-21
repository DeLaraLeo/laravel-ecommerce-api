<?php

namespace App\Providers;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            \App\Domain\Repositories\PasswordResetTokenRepositoryInterface::class,
            \App\Infrastructure\Persistence\EloquentPasswordResetTokenRepository::class
        );

        $this->app->bind(
            \App\Domain\Repositories\RoleRepositoryInterface::class,
            \App\Infrastructure\Persistence\EloquentRoleRepository::class
        );

        $this->app->bind(
            \App\Domain\Repositories\PermissionRepositoryInterface::class,
            \App\Infrastructure\Persistence\EloquentPermissionRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
