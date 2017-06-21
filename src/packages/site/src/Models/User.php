<?php



namespace Belif\Mobile\Models;


use Soup\Mobile\Models\UserProfile;
use Soup\Mobile\Models\Reservation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

use Carbon\Carbon;

class User extends Model implements AuthenticatableContract {


	//set model table name
    protected $table = 'user';



	
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
    


//use Illuminate\Auth\UserInterface;
//
//class User extends Eloquent { //implements UserInterface {
//
//	//set model connection (probably should rename user class to avoid conflict with Laravel User model)
//	protected $connection = 'Belif';
//




    /**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
 /*   public function getAuthIdentifier()
    {
        return $this->getKey();
    }
*/
    /**
	 * Get the password for the user.
	 *
	 * @return string
	 */
  /*  public function getAuthPassword()
    {
        return $this->email;
    }



        

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
    */

} //end class User


?>