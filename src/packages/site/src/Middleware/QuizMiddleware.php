<?php 

	namespace Belif\Mobile\Middleware; 

	use Belif\Mobile\Lib\AppGlobals;

	use Closure;
	use Redirect;
	use Illuminate\Support\Facades\Auth;

	class QuizMiddleware { 

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
			//ensure user is capable of registration
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			if (!$user) {
				return Redirect::route('soup.login');
			}
			
			//quiz complete
			if ($user->quiz_complete) {
				
				//show main page
				return Redirect::route('soup.venue.recommendation');
			} 
	*/
			//process request
	        return $next($request);
	        
	    } //end handle()
	
	} //end class QuizMiddleware
	
?>