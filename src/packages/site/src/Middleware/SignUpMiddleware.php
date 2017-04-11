<?php 

	namespace Soup\Mobile\Middleware; 

	use Soup\Mobile\Lib\AppGlobals;

	use Closure;
	use Redirect;
	use Illuminate\Support\Facades\Auth;

	class SignUpMiddleware { 

	    /**
	     * Handle an incoming request.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  \Closure  $next
	     * @return mixed
	     */
	    public function handle($request, Closure $next)
	    {
	
		   	//ensure https connection 
//		    if (!$request->secure()) {
//		    	return Redirect::secure( $request->path('/toSecureURL') );
//		    }
	
		    //ensure user is logged in
			if (!Auth::guard(AppGlobals::$AUTH_GUARD)->check()) {
		        return Redirect::route('soup.welcome');
		    }
	
			//ensure user is capable of registration
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			if (!$user) {
				return Redirect::route('soup.login');
			}
			//non-signup member
			switch ($user->status) {
				
				case AppGlobals::USER_STATUS_INQUIRY:
				case AppGlobals::USER_STATUS_REGISTERED: 
				case AppGlobals::USER_STATUS_REQUESTED:
					//allow connection
					break;
					
				default:
					//$errorMessage = 'Sorry, looks like you\'ve already registered with that email. Please login to continue.';
					return Redirect::route('soup.login'); //->withErrors($errorMessage);
				break;
				
			} //end switch (user status)
	
			//process request
	        return $next($request);
	        
	    } //end handle()
	
	} //end class SignUpMiddleware
	
?>