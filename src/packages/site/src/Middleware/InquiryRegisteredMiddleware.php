<?php 

	namespace Soup\Mobile\Middleware; 

	use Soup\Mobile\Lib\AppGlobals;

	use Closure;
	use Redirect;
	use Illuminate\Support\Facades\Auth;

	class InquiryRegisteredMiddleware { 

	    /**
	     * Handle an incoming request.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  \Closure  $next
	     * @return mixed
	     */
	    public function handle($request, Closure $next)
	    {
	
		    //ensure user is logged in
			if (!Auth::guard(AppGlobals::$AUTH_GUARD)->check()) {
		        return Redirect::route('soup.welcome');
		    }
	
			//ensure user is capable of registration
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			if (!$user) {
				return Redirect::route('soup.login');
			}
			
			//check member status
			switch ($user->status) {
				
				//non-requested member
				case AppGlobals::USER_STATUS_INQUIRY:
				case AppGlobals::USER_STATUS_REGISTERED: 
					//allow connection
					break;
					
				//requested
				case AppGlobals::USER_STATUS_REQUESTED: 
					return Redirect::route('soup.signup.code');
					break;
					
				default:
					return Redirect::route('soup.quiz');
				break;
				
			} //end switch (user status)
	
			//process request
	        return $next($request);
	        
	    } //end handle()
	
	} //end class InquiryRegisteredMiddleware
	
?>