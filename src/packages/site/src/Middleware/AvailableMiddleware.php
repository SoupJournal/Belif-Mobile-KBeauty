<?php 

	namespace Belif\Mobile\Middleware; 

	use Belif\Mobile\Models\Product;

	use Closure;
	use Redirect;
	use Illuminate\Support\Facades\Auth;

	class AvailableMiddleware { 

	    /**
	     * Handle an incoming request.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  \Closure  $next
	     * @return mixed
	     */
	    public function handle($request, Closure $next)
	    {
	    	
			//get available products
			$products = Product::where('available', true)->get();
			
			//no products available
			if (!$products || count($products)<=0) {
				
				//show no products available
				return Redirect::route('belif.unavailable');
			} 
	
			//process request
	        return $next($request);
	        
	    } //end handle()
	
	} //end class AvailableMiddleware
	
?>