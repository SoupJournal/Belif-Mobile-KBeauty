<?php 

	namespace Soup\Mobile\Middleware; 

	use Soup\Mobile\Lib\AppGlobals;
	use Soup\Mobile\Models\Review;
	use Soup\Mobile\Models\Reservation;

	use Closure;
	use Redirect;
	use Illuminate\Support\Facades\Auth;
	use Carbon\Carbon;

	class ReviewMiddleware { 

	    /**
	     * Handle an incoming request.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  \Closure  $next
	     * @return mixed
	     */
	    public function handle($request, Closure $next)
	    {
	
			//check for incomplete reviews
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			if ($user) {
				
				//get active review time
				$reviewTime = Carbon::now()->subHours(2);

				//check for incomplete reviews
				$reservation = Reservation::whereDate('date', '<', $reviewTime)
										  ->where('review_notified', 0)
										  ->first();
//				$reservation = Reservation::whereDate('date', '<', $reviewTime)
//								->whereHas('review', function($query) {
//								  	$query->where('status', '!=', AppGlobals::REVIEW_STATUS_REQUIRED);
//								}, '=', 0)
//							  	->first();			  

				//found reservation
				if ($reservation) {

					//update reservation state
					$reservation->review_notified = true;
					$reservation->save();

//					//update review state
//					$review = $reservation->review();
//					if ($review) {
//						$review = new Review();
//						$review->reservation = $reservation->id;
//					}
//					$review->status = AppGlobals::
					
					//show review page
					return Redirect::route('soup.reservation.review.id', ['code' => $reservation->code]);
					
				}
				
			} //end if (valid user)
			

			//process request
	        return $next($request);
	        
	    } //end handle()
	
	} //end class ReviewMiddleware
	
?>