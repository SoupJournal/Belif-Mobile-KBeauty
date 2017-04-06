<?php

namespace Soup\Mobile\Models;


use Soup\Mobile\Models\SoupUser;

use Illuminate\Database\Eloquent\Model;



class PasswordReset extends Model {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'password_reset';



		//==========================================================//
		//====				RELATIONSHIP METHODS				====//
		//==========================================================//	
			

	/**
     * Get the user associated with this profile.
     */
	public function user() {
    
        return $this->belongsTo(SoupUser::class, 'user', 'id');
        
    } //end user()
    
    

} //end class PasswordReset


?>