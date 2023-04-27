<?php

namespace App\Providers;

use App\Models\User;
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
    public const HOME = '/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //Route::model('nickname', User::class);

        $this->configureRateLimiting();

        $this->routes(function () {

            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web', 'auth')
                ->prefix('account')
                ->namespace($this->namespace)
                ->group(base_path('routes/account.php'));

            Route::middleware('api')
                ->prefix('api/v1/{nickname}') //esta es la url
                ->namespace($this->namespace)
                ->group(base_path('routes/api-v1.php'));

            Route::middleware('web', 'auth')
                ->prefix('user')
                ->namespace($this->namespace)
                ->group(base_path('routes/user.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));


            /**** OJO, POR SEGURIDAD, LAS RUTAS QUE SE PONGA AQUI DEBEN ESTA ARRIBA DE ESTAS LINEAS */

            Route::middleware('web', 'auth')
                ->prefix('{nickname}/manage')
                ->namespace($this->namespace)
                ->group(base_path('routes/manage.php'));

            // Route::middleware('web', 'auth')
            //     ->prefix('{nickname}/store')
            //     ->namespace($this->namespace)
            //     ->group(base_path('routes/store.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
