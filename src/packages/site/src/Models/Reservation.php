<?php

namespace Soup\Mobile\Models;


use Soup\Mobile\Models\Venue;
use Soup\Mobile\Models\SoupUser;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;



class Reservation extends Model {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'reservation';
    
    
    
		//==========================================================//
		//====				RELATIONSHIP METHODS				====//
		//==========================================================//	
			

	/**
     * Get the user data associated with this reservation.
     */
	public function user() {
    
        return $this->belongsTo(SoupUser::class, 'user', 'id');
        
    } //end user()



	/**
     * Get the venue data associated with this reservation.
     */
	public function venue() {
    
        return $this->hasOne(Venue::class, 'id', 'venue');
        
    } //end venue()
    
    
    
	/**
     * Get the review data associated with this reservation.
     */
	public function review() {

//        return $this->hasOne(Review::class, 'id', 'reservation');    
        return $this->belongsTo(Review::class, 'id', 'reservation');
        
    } //end review()
    
    
    
		//==========================================================//
		//====				ACCESSOR METHODS					====//
		//==========================================================//	
			

	public function getDateAttribute($date) {
	
	    return $date ? Carbon::parse($date) : null; 
	    	    
	} //end getDateAttribute()
	
	
	public function setDateAttribute($date) {
	
		$this->attributes['date'] = Carbon::parse($date);
	    
	} //end setDateAttribute()



} //end class Reservation


?>