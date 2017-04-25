<?php

namespace Soup\Mobile\Models;


use Soup\Mobile\Models\Venue;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;



class VenueBlockedHours extends Model {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'venue_blocked_hours';
    
 
 
 
 
		//==========================================================//
		//====				RELATIONSHIP METHODS				====//
		//==========================================================//	
			   
    
    
	/**
     * Get the venue data associated with these hours.
     */
	public function venue() {
    
        return $this->belongsTo(Venue::class, 'venue', 'id');
        
    } //end venue()
    
    
    
    

		//==========================================================//
		//====				ACCESSOR METHODS					====//
		//==========================================================//	
			



	public function getStartDateAttribute($date) {
	
	    return $date ? Carbon::parse($date) : null;	   
	     
	} //end getStartDateAttribute()
	
	
	public function setStartDateAttribute($date) {
	
		$this->attributes['start_date'] = Carbon::parse($date);
	    
	} //end setStartDateAttribute()
	
	
	public function getEndDateAttribute($date) {
	
	    return $date ? Carbon::parse($date) : null;	   
	     
	} //end getEndDateAttribute()
	
	
	public function setEndDateAttribute($date) {
	
		$this->attributes['end_date'] = Carbon::parse($date);
	    
	} //end setEndDateAttribute()
    

} //end class VenueBlockedHours


?>