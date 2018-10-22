<?php 

	namespace Belif\Mobile\Middleware; 


	use Closure;
	use Redirect;

	class HTTPSMiddleware {

	    /**
	     * Handle an incoming request.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  \Closure  $next
	     * @return mixed
	     */
	    public function handle($request, Closure $next)
	    {
            if (env('APP_ENV') != 'local') {
                // ensure https connection
                if (!$request->secure()) {
                    #return Redirect::secure($request->path('/toSecureURL'));
                }
            }
	
			//process request
	        return $next($request);
	        
	    } //end handle()
	
	} //end class HTTPSMiddleware
	
?>