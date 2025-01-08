<?php

namespace APP\Providers;

//use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
	public function boot()
	{
        $this->routes(function(){

            $this->mapApiRoutes();
            $this->mapWebRoutes();
        });
    }

	/**
	 * Define the api routes
	 */
	protected function mapApiRoutes()
	{
		Route::prefix('api')
			->middleware('api')
            ->namespace($this->namespace)
			->group(base_path('routes/api.php'));
    }

    /**
    * Define the web routes
    */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
		    ->group(base_path('routes/web.php'));
    }
}
