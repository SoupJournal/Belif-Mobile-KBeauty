<?php

namespace Soup\Mobile\Models;


use Soup\Mobile\Models\UserProfile;
use Soup\Mobile\Models\Reservation;

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
     * Get the profile data associated with this user.
     */
	public function reservations() {
    
        return $this->hasMany(Reservation::class, 'venue', 'id');
        
    } //end reservations()



} //end class Venue


?>