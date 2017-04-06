<?php 

	namespace Soup\Mobile\Middleware; 

	use Soup\Mobile\Lib\AppGlobals;

	use Closure;
	use Redirect;
	use Illuminate\Support\Facades\Auth;

	class AuthMiddleware { 

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
		    if (!$request->secure()) {
		    	return Redirect::secure( $request->path('/toSecureURL') );
		    }
		    
		    //ensure user is logged in
			if (!Auth::guard(AppGlobals::$AUTH_GUARD)->check()) {
		        return Redirect::route('soup.login');
		    }
		    
		    //get user
		    $user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
		    if (!$user || $user->status!=AppGlobals::USER_STATUS_MEMBER) {
		    	return Redirect::route('soup.login');
		    }
	
			//process request
	        return $next($request);
	        
	    } //end handle()
	
	} //end class AuthMiddleware
	
?>