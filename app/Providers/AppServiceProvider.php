<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;    

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
public function boot(): void
    {
        // Mendefinisikan bahwa Gate 'admin' hanya untuk user yang role-nya 'admin'
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });
    }
}
