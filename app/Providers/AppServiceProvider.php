<?php

namespace App\Providers;

use App\Models\Discussion;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Model::shouldBeStrict(! $this->app->isProduction());

        Relation::morphMap([
            'status' => Status::class,
            'discussion' => Discussion::class,
        ]);

        Gate::define('admin', fn (User $user) => $user->id === config('puklipo.users.admin'));
    }
}
