<?php

namespace Soup\Mobile\Models;


//use Soup\Mobile\Models\Venue;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;



class VenueOpenHours extends Model {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'venue_open_hours';
    
    


 
 
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
			



	public function getOpenTimeAttribute($date) {
	
		return $date ? Carbon::createFromFormat('H:i:s', $date) : null;
	    //return $date ? Carbon::parse($date) : null;	   
	     
	} //end getOpenTimeAttribute()
	
	
	public function setOpenTimeAttribute($date) {
	
		$this->attributes['open_time'] = Carbon::parse($date);
	    
	} //end setOpenTimeAttribute()
	
	
	public function getCloseTimeAttribute($date) {
	
		return $date ? Carbon::createFromFormat('H:i:s', $date) : null;
	    //return $date ? Carbon::parse($date) : null;	   
	     
	} //end getCloseTimeAttribute()
	
	
	public function setCloseTimeAttribute($date) {
	
		$this->attributes['close_time'] = Carbon::parse($date);
	    
	} //end setCloseTimeAttribute()
    

} //end class VenueOpenHours


?>