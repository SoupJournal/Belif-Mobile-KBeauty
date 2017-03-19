<?php

namespace Soup\Mobile\Models;


use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;



class Reservation extends Model {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'reservation';
    
    
    
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