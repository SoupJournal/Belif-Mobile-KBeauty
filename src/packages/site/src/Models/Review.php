<?php

namespace Soup\Mobile\Models;


use Soup\Mobile\Models\Venue;
use Soup\Mobile\Models\SoupUser;
use Soup\Mobile\Models\Reservation;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;



class Review extends Model {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'review';
    
    
    
		//==========================================================//
		//====				RELATIONSHIP METHODS				====//
		//==========================================================//	
			

	/**
     * Get the user data associated with this review.
     */
	/*public function user() {
    
        return $this->hasOne(SoupUser::class, 'id', 'user');
        
    } //end user()
*/


	/**
     * Get the venue data associated with this review.
     */
	/*public function venue() {
    
        return $this->hasOne(Venue::class, 'id', 'venue');
        
    } //end venue()
    */
    
    
	/**
     * Get the reservation data associated with this review.
     */
	public function reservation() {
    
    	return $this->hasOne(Reservation::class, 'id', 'reservation');
        //return $this->belongsTo(Reservation::class, 'id', 'reservation');
        
    } //end reservation()
    
   


} //end class Review


?>