<?php

namespace Soup\Mobile\Models;


use Soup\Mobile\Models\Reservation;
use Soup\Mobile\Models\VenueOpenHours;
use Soup\Mobile\Models\VenueBlockedHours;

use Illuminate\Database\Eloquent\Model;



class Venue extends Model {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'venue';
    


		//==========================================================//
		//====				RELATIONSHIP METHODS				====//
		//==========================================================//	
			

	/**
     * Get the reservations data associated with this user.
     */
	public function reservations() {
    
        return $this->hasMany(Reservation::class, 'venue', 'id');
        
    } //end reservations()



	/**
     * Get the open hours data associated with this user.
     */
	public function openHours() {
    
        return $this->hasMany(VenueOpenHours::class, 'venue', 'id');
        
    } //end openHours()



	/**
     * Get the blocked hours data associated with this user.
     */
	public function blockedHours() {
    
        return $this->hasMany(VenueBlockedHours::class, 'venue', 'id');
        
    } //end blockedHours()
    
    

} //end class Venue


?>