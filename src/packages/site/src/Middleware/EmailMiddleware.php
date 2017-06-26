<?php 

	namespace Belif\Mobile\Middleware; 


	use Session;
	use Closure;
	use Redirect;
	use Illuminate\Support\Facades\Auth;

	class EmailMiddleware { 

	    /**
	     * Handle an incoming request.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  \Closure  $next
	     * @return mixed
	     */
	    public function handle($request, Closure $next)
	    {
	
			//get email
			$email = Session::get('email');
	
		   	//ensure email is specified
		    if (!$email || strlen($email)<=0) {
		    	return Redirect::route( 'belif.home' );
		    }
	
			//process request
	        return $next($request);
	        
	    } //end handle()
	
	} //end class EmailMiddleware
	
?>