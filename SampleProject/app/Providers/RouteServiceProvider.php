<?php

namespace APP\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->mapApiRoutes();
		$this->mapWebRoutes();
	}

	/**
	 * Define the api routes
	 */
	protected function mapApiRoutes()
	{
		Route::prefix('api')
			->middleware('api')
			->group(base_path('routes/api.php'));
	}

	/**
	 * Define the web routes
	 */
	protected function mapWebRoutes()
	{
		Route::middleware('web')
			->group(base_path('routes/web.php'));
	}
}
