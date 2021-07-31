<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var null|string
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'))
            ;

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'))
            ;

            $names = ['admin', 'user', 'teacher'];
            for ($i = 0; $i < count($names); ++$i) {
                $roles = 'admin' === $names[$i] ? 'admin|supervisor' : $names[$i];

                Route::prefix($names[$i])
                    ->middleware(['auth:sanctum', 'role:'.$roles, 'throttle:'.$names[$i], $names[$i], 'verified'])
                    ->namespace($this->namespace.'\\'.ucfirst($names[$i]))
                    ->as($names[$i].'.')
                    ->group(base_path('routes/'.$names[$i].'.php'))
                ;
            }
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });

        RateLimiter::for('user', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id);
        });

        RateLimiter::for('teacher', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id);
        });

        RateLimiter::for('admin', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id);
        });

        RateLimiter::for('contact-us', function (Request $request) {
            return Limit::perMinute(5)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
