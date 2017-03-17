<?php

namespace Soup\Mobile\Models;


use Soup\Mobile\Models\UserProfile;

use Illuminate\Database\Eloquent\Model;



class UserProfile extends Model {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'user_profile';



		//==========================================================//
		//====				RELATIONSHIP METHODS				====//
		//==========================================================//	
			

	/**
     * Get the user associated with this profile.
     */
	public function user() {
    
        return $this->belongsTo(SoupUser::class, 'user', 'id');
    }
    
    
	/**
     * Get the question associated with this profile.
     */
	public function question() {
    
        return $this->belongsTo(Question::class, 'question', 'key');
        
    } //end questionData()



} //end class UserProfile


?>