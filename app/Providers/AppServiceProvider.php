<?php

namespace App\Providers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Puklipo\Vapor\Middleware\GzipResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
        ]);

        Gate::define('admin', fn (User $user) => $user->id === config('puklipo.users.admin'));

        Gate::define('tips', fn (User $user) => $user->id === config('puklipo.users.tips'));

        GzipResponse::encodeWhen(function (Request $request, mixed $response): bool {
            return in_array('gzip', $request->getEncodings())
                //&& $request->method() === 'GET'
                && function_exists('gzencode')
                && ! $response->headers->contains('Content-Encoding', 'gzip')
                && ! $response instanceof BinaryFileResponse;
        });
    }
}
