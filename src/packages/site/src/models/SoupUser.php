<?php

namespace Soup\Mobile\Models;


use Soup\Mobile\Models\UserProfile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

use Carbon\Carbon;

class SoupUser extends Model implements AuthenticatableContract {

	//set model connection 
	protected $connection = 'Soup';

	//set model table name
    protected $table = 'user';

	//set date fields
	protected $dates = ['birth_date'];

//	protected $fillable = [
//		'birth_date'
//	];


	/**
	 * Get the attributes that should be converted to dates.
	 *
	 * @return array
	 */
//	public function getDates() {
//	
//	    return array_merge(parent::getDates(), array('birth_date'));
//	    
//	}


		//==========================================================//
		//====				RELATIONSHIP METHODS				====//
		//==========================================================//	
			

	/**
     * Get the profile data associated with this user.
     */
	public function profile() {
    
        return $this->hasMany(UserProfile::class, 'user', 'id');
        
    } //end profile()




		//==========================================================//
		//====				ACCESSOR METHODS					====//
		//==========================================================//	
			



	public function getBirthDateAttribute($date) {
	
	    return $date ? Carbon::parse($date) : null; //new Carbon($date); //(new Carbon($date))->format('m/d/Y');
	    
	} //end getBirthDateAttribute()
	
	
	public function setBirthDateAttribute($date) {
	
		$this->attributes['birth_date'] = Carbon::parse($date);
	    //return (new Carbon($date))->format('m/d/Y');
	    
	} //end setBirthDateAttribute()


	
		//==========================================================//
		//====				AUTHENTICATION METHODS				====//
		//==========================================================//	
			


    /**
	 * Get the unique identifier name for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifierName()
	{
	    return $this->getKeyName(); //return column name 'id'
	}


    /**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
    public function getAuthIdentifier()
    {
        return $this->getKey(); //return user id
    }


    /**
	 * Get the password for the user.
	 *
	 * @return string
	 */
    public function getAuthPassword()
    {
        return $this->password;
    }




    /**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
//    public function getReminderEmail()
//    {
//        return $this->email;
//    }
        

    public function getRememberToken()
    {
        return $this->remember_token;
    }


    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
    

} //end class SoupUser


?>