<?php 

	namespace Soup\Mobile\Middleware; 

	use Soup\CMS\Lib\CMSAccess;

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
	
		    //ensure user is logged in
			if (!Auth::guard(AppGlobals::$AUTH_GUARD)->check()) {
		        return Redirect::route('soup.login');
		    }
		   
		   	//ensure https connection 
		    if (!$request->secure()) {
		    	return Redirect::secure( $request->path('/toSecureURL') );
		    }
	
			//process request
	        return $next($request);
	        
	    } //end handle()
	
	} //end class AuthMiddleware
	
?>