<?php



		//==========================================================//
		//====					FORM VALIDATION					====//
		//==========================================================//	
	


	function validEmail($email = NULL) {
		
		if ($email!=NULL && strlen($email)>0) {
		
			//trim white space
           	$email = trim($email);
           	
			//get length
			$emailLength = strlen($email);
           	if ($emailLength>4) {
               
                //find range of key characters
                $atIndex = strpos($email, "@");
                $dotIndex =  strrpos($email, ".");
                $atOccurrences = substr_count($email, "@");
               
                //valid format
                if ($atIndex>0 && $dotIndex>($atIndex+1) && $atOccurrences<2 && $dotIndex<$emailLength-1) {
                    return true;
                }
               
               
           	} //end if (valid length)
		
		
		} //end if (email exists)
		
		
		//invalid email
		return false;
		
	} //end validEmail()





		//==========================================================//
		//====					SERVER FUNCTIONS				====//
		//==========================================================//	
	


	function retrieveIPAddress() {
		
		$ip = NULL;
		
		//retrieve value
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} 
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} 
		else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}
		
		return $ip;
		
	} //end retrieveIPAdress()



	function isMobileDevice(){
		
		//mobile user agents
	    $mobileUserAgents = array(
	        '/iphone/i' => 'iPhone', 
	        '/ipod/i' => 'iPod', 
	        '/ipad/i' => 'iPad', 
	        '/android/i' => 'Android', 
	        '/windows phone/i' => 'Windows', 
	        '/blackberry/i' => 'BlackBerry', 
	        '/symbianos/i' => 'Symbian', 
	        '/mobile/i' => 'Mobile/Tzien',
	        '/webos/i' => 'Mobile',
	        '/phone/i' => 'Mobile'
	    );
//echo "AGENT: " . $_SERVER['HTTP_USER_AGENT'];
//exit(0);	
	    //check if Mobile User Agent is detected
	    foreach($mobileUserAgents as $mobileKey => $mobileOS){
	        if(preg_match($mobileKey, $_SERVER['HTTP_USER_AGENT'])){
	            return true;
	        }
	    }
 
	    //assume desktop  
	    return false;
	    
	} //end isMobileDevice()
	
	
	
	
		//==========================================================//
		//====						USER DATA					====//
		//==========================================================//	
	
	
	function extractModelValues($valueKey, $valuesArray) {
		
		$extracted = null;
		
		//valid key
		if ($valueKey && strlen($valueKey)>0) {
			
			//array exists
			if ($valuesArray) {
				
				//convert array (if required)
				if (is_a($valuesArray, 'Illuminate\Database\Eloquent\Collection')) {
					$valuesArray = $valuesArray->toArray();
				}
				
				//valid array
				if (is_array($valuesArray) && count($valuesArray)>0) {
				
					$extracted = array_map(function($data) use ($valueKey) { 
						
						//valid value
						if (array_key_exists($valueKey, $data)) {
							return $data[$valueKey];	
						} 
						
						//no match found
						return null; 
						
					}, $valuesArray);	
					
				} //end if (valid array)
			
			} //end if (array exists)
			
		} //end if (valid key)
		
		
		return $extracted;
		
	} //end extractModelValues()
	
	
	
	
	function fullName($user, $default = null) {
		
		$name = $default;
		
		//valid user
		if ($user) {
			
			//append first name
			if (isset($user->first_name) && strlen($user->first_name)>0) {
				$name = $user->first_name;
			}
			
			//append last name
			if (isset($user->last_name) && strlen($user->last_name)>0) {
				
				//append name
				if ($name && strlen($name)>0) {
					$name .= ' ' . $user->last_name;
				}
				
				//set name
				else {
					$name = $user->last_name;
				}
			}
			
		} //end if (valid user)
		
		return $name;
		
	} //end fullName()
	
	
	
	function userAge($user, $default = null) {
		
		$age = $default;
		
		//valid user
		if ($user) {
			
			//valid birth date
			if (isset($user->birth_date)) {
				$age = $user->birth_date->diffInYears(Carbon\Carbon::now());
			}
			
			
		} //end if (valid user)
		
		return $age;
		
	} //end userAge()
	
	
	
	
	function fullAddress($user, $default = null) {
		
		$address = $default;
		
		//valid user
		if ($user) {
			
			//append address 1
			if (isset($user->address_1) && strlen($user->address_1)>0) {
				$address = $user->address_1;
			}
			
			//append address 2
			if (isset($user->address_2) && strlen($user->address_2)>0) {
				
				//append address
				if ($address && strlen($address)>0) {
					$address .= ' ' . $user->address_2;
				}
				
				//set address
				else {
					$address = $user->address_2;
				}
			}
			
			//append city
			if (isset($user->city) && strlen($user->city)>0) {
				
				//append address
				if ($address && strlen($address)>0) {
					$address .= ', ' . $user->city;
				}
				
				//set address
				else {
					$address = $user->city;
				}
			}
			
			//append state
			if (isset($user->state) && strlen($user->state)>0) {
				
				//append address
				if ($address && strlen($address)>0) {
					$address .= ', ' . $user->state;
				}
				
				//set address
				else {
					$address = $user->state;
				}
			}
			
			//append zip code
			if (isset($user->zip_code) && strlen($user->zip_code)>0) {
				
				//append address
				if ($address && strlen($address)>0) {
					$address .= ' ' . $user->zip_code;
				}
				
				//set address
				else {
					$address = $user->zip_code;
				}
			}
//			
//			//append country
//			if (isset($user->country) && strlen($user->country)>0) {
//				
//				//append address
//				if ($address && strlen($address)>0) {
//					$address .= ', ' . $user->country;
//				}
//				
//				//set address
//				else {
//					$address = $user->country;
//				}
//			}
			
			
		} //end if (valid user)
		
		return $address;
		
	} //end fullAddress()
	
?>