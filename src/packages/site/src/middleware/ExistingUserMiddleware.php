<?php 

	namespace Soup\Mobile\Middleware; 

	use Soup\Mobile\Lib\AppGlobals;

	use Closure;
	use Redirect;
	use Illuminate\Support\Facades\Auth;

	class ExistingUserMiddleware { 

	    /**
	     * Handle an incoming request.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  \Closure  $next
	     * @return mixed
	     */
	    public function handle($request, Closure $next)
	    {
	/*
		   	//ensure https connection 
		    if (!$request->secure()) {
		    	return Redirect::secure( $request->path('/toSecureURL') );
		    }
	
		    //ensure user is NOT logged in
			if (Auth::guard(AppGlobals::$AUTH_GUARD)->check()) {
				
				//ensure user is capable of registration
				$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
				
				//redirect member
				switch ($user->status) {
					
					case AppGlobals::USER_STATUS_MEMBER:
						return Redirect::route('soup.quiz'); //TODO: direct to home
					break;
					
					case AppGlobals::USER_STATUS_INQUIRY:
						return Redirect::route('soup.signup.info');
					break;
					
					case AppGlobals::USER_STATUS_REGISTERED: 
					case AppGlobals::USER_STATUS_REQUESTED:
					default:
						return Redirect::route('soup.signup.code');
					break;
					
				} //end switch (user status)
				
		    }
	
	*/
			//process request
	        return $next($request);
	        
	    } //end handle()
	
	} //end class ExistingUserMiddleware
	
?>