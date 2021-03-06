<?php 

	namespace Belif\Mobile\Middleware; 


	use Closure;
	use Redirect;
	use Illuminate\Support\Facades\Auth;
	use Carbon\Carbon;

	class MobileMiddleware { 

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
		    if (!isMobileDevice()) {
	    	
				//show desktop page
				return Redirect::route('belif.desktop');
					
			} //end if (valid user)
			

			//process request
	        return $next($request);
	        
	    } //end handle()
	
	} //end class MobileMiddleware
	
?>