<?php 

	namespace Belif\Mobile\Middleware; 


	use Session;
	use Closure;
	use Redirect;
	use Illuminate\Support\Facades\Auth;

	class ProductMiddleware { 

	    /**
	     * Handle an incoming request.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  \Closure  $next
	     * @return mixed
	     */
	    public function handle($request, Closure $next)
	    {
	
			//get selected products
			$selectedProducts = Session::get('selectedProducts');
	
		    //ensure has selected a product
			if (!$selectedProducts || count($selectedProducts)<=0) {
		        return Redirect::route('belif.results');
		    }
	
			//process request
	        return $next($request);
	        
	    } //end handle()
	
	} //end class ProductMiddleware
	
?>