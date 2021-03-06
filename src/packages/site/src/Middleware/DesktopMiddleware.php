<?php 

	namespace Belif\Mobile\Middleware; 


	use Closure;
	use Redirect;
	use Illuminate\Support\Facades\Auth;
	use Carbon\Carbon;

	class DesktopMiddleware { 

	    /**
	     * Handle an incoming request.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  \Closure  $next
	     * @return mixed
	     */
	    public function handle($request, Closure $next)
	    {
	
			//non-mobile device
		    if (isMobileDevice()) {
	    	
				//show welcome page
				return Redirect::route('belif.home');
					
			} //end if (valid user)
			

			//process request
	        return $next($request);
	        
	    } //end handle()
	
	} //end class DesktopMiddleware
	
?>