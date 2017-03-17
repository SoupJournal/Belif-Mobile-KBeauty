<?php

namespace Soup\Mobile\Models;


use Soup\Mobile\Models\UserProfile;

use Illuminate\Database\Eloquent\Model;



class Question extends Model {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'question';





		//==========================================================//
		//====				RELATIONSHIP METHODS				====//
		//==========================================================//	
			

	/**
     * Get the profile data associated with this question.
     */
	public function profile() {
    
        return $this->hasMany(UserProfile::class, 'question', 'key');
        
    } //end profile()
    
    

} //end class Question


?>