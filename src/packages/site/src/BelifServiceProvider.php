<?php namespace Belif\Mobile;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\AliasLoader;

class BelifServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;



	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		//set default time to New York
		date_default_timezone_set('America/New_York');
		
		//add forms support (TODO: check if support already available)
		$loader = AliasLoader::getInstance();
		if ($loader) {
	        $loader->alias('Form', \Collective\Html\FormFacade::class);
        	$loader->alias('HTML', \Collective\Html\HtmlFacade::class);
		}
		App::register('Collective\Html\HtmlServiceProvider');

		//register middleware
		$router = $this->app['router'];
		if ($router) {
			$router->middleware('AppHTTPS', 'Belif\Mobile\Middleware\HTTPSMiddleware');
//			$router->middleware('AppAuth', 'Soup\Mobile\Middleware\AuthMiddleware');	
//			$router->middleware('AppSignUp', 'Soup\Mobile\Middleware\SignUpMiddleware');
//			$router->middleware('NewSignUp', 'Soup\Mobile\Middleware\InquiryRegisteredMiddleware');
			$router->middleware('ProductAvailable', 'Belif\Mobile\Middleware\AvailableMiddleware');
			$router->middleware('ProductRequired', 'Belif\Mobile\Middleware\ProductMiddleware');
			$router->middleware('EmailRequired', 'Belif\Mobile\Middleware\EmailMiddleware');
			$router->middleware('AppMobile', 'Belif\Mobile\Middleware\MobileMiddleware');
			$router->middleware('AppDesktop', 'Belif\Mobile\Middleware\DesktopMiddleware');
		}

		//include package routes
		include __DIR__.'/routes.php';
		
		//include package composers
		include __DIR__.'/composers.php';
		
		//include package helpers
		include __DIR__.'/helpers/CMSHelper.php';
		include __DIR__.'/helpers/DataHelper.php';

		//load views
		$this->loadViewsFrom(__DIR__.'/views', 'belif');

		//publish assets
		$this->publishes([
		    __DIR__.'/../public' => public_path('belif/mobile'),
		], 'public');

		// force HTTPS (used because Nginx runs HTTP behind AWS portal)
        if (env('APP_ENV') != 'local') {
		    \URL::forceSchema('https');
        }

	} //end boot()



	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

	} //end register()
	
	

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
		
	} //end provides()


} //end class BelifServiceProvider


