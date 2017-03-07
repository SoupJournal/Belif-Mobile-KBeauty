<?php

namespace Soup\Mobile\Models;

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



		//==========================================================//
		//====				ACCESSOR METHODS					====//
		//==========================================================//	
			



	public function getBirthDateAttribute($date) {
	
	    return (new Carbon($date))->format('m/d/Y');
	    
	} //end getBirthDateAttribute()


	
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