<?php

	//setup namespace
	use Carbon\Carbon;
	use Soup\Mobile\Models\VenueOpenHours;


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




	function parseDateString($dateString, $formats = null) {
		
		$date = null;
		
		//valid date string
		if ($dateString && strlen($dateString)>0) {
			
			//use default formats (if required)
			if (!$formats) {
				$formats = [
					'm/d/Y',
					'm\\d\\Y',
					'm-d-Y',
					'Y-m-d',
					'Y-d-m'
				];
			}
			
			//formats specified
			if ($formats && count($formats)>0) {
				
				//convert date
				foreach ($formats as $format) {
					
					try {
						
						//convert date
						$date = Carbon::createFromFormat($format, $dateString);
						break;
						
					}
					catch (\Exception $ex) {
						$date = null;
						continue;
					}
					
				} //end for()
				
			} //end if (valid formats)
			
		} //end if (valid date string) 
		
		
		return $date;
		
	} //end parseDateString()
	
	
	


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
		//====					UTIL FUNCTIONS					====//
		//==========================================================//	
	
	
	
	function generateUniqueCode($baseSeed = null, $length = -1, $start = -1) {
		
		//create unique string
		$baseString = ($baseSeed?$baseSeed:"") . microtime() . uniqid();
		
		//encrypt code
		$code = hash('sha256', $baseString);	
		
		//limit code
		if ($length>0 && strlen($code)>$length) {
			
			//determine clip start
			if ($start<0) {
				$start = intval((strlen($code) - $length) * 0.5);
				if ($start<0) $start = 0;
			}
			
			//clip string
			$code = substr($code, $start, $length);	
		}

		return $code;

	} //end generateUniqueCode()
	
	
	
		//==========================================================//
		//====					DATA FUNCTIONS					====//
		//==========================================================//	
	
	


	//====== QUIZ DATA ======//
				
				
	function activeQuestionNumber($user, $questionsData) {
		
		$questionId = 0;
		
		//valid data
		if ($user && $questionsData && count($questionsData)>0) { 
			
			try {
			
				//get profile data
				$profiles = json_decode($user->answered_questions);
				//$profiles = $user->profile()->groupby('question')->get();
	
				//found profile data
				if ($profiles && count($profiles)>0) {

					//find question data
					$foundAnswer = false;
					foreach ($questionsData as $question) {
			
						//reset answer state
						$foundAnswer = false;
						
						//check if question answered
						foreach ($profiles as $profile) {

							//question was answered
							if (strcmp($question['key'], $profile)==0) {
								++$questionId;
								$foundAnswer = true;
								break;
							}
							
						} //end for()
						
						//no match found
						if (!$foundAnswer) {
							break;
						}
			
			
					} //end for()
				
				}
			
			}
			catch (Exception $ex) {
				
			}
			
		} //end if (valid data)

		return $questionId;
		
	} //end activeQuestionNumber()
					
	
	
	//====== USER DATA ======//
	
	
	//TODO: convert to use compilePropertiesString()
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
				$age = $user->birth_date->diffInYears(Carbon::now());
			}
			
			
		} //end if (valid user)
		
		return $age;
		
	} //end userAge()
	
	
	
	
	
	//====== VENUE DATA ======//
	
	function venueTodaysOpenHoursString($venue, $default = null) {
		
		$result = $default;
		
		//valid venue
		if ($venue) {
		
			//get day of week
			$day = Carbon::now()->format('l');
			if ($day && strlen($day)>0) {
				
				//find open hours
				$hours = VenueOpenHours::select('open_time', 'close_time')->where('day', '=', $day)->first();
				if ($hours) {
					
					//get times
					$openTime = $hours->open_time;
					$closeTime = $hours->close_time;
					
					//bounds check
					if (!$openTime) $openTime = Carbon::today();
					if (!$closeTime) $closeTime = Carbon::tomorrow();
					
					//determine hours open
					$hours = 0;
					$hours = $closeTime->diffInHours($openTime);
					
					//venue has open hours today
					if ($hours>0) {
						$result = "Open until " . $closeTime->format('g:i A');
					}
					
				}
				
				
			} //end if (valid day)
		
		} //end if (valid venue)
		
		return $result;
		
	} //end venueTodaysOpenHoursString()
	
	
	
	
	
	//====== GENERIC DATA ======//
	
	
	
	
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
	
	
	
	
	
	function compilePropertiesString($source, $properties, $separators = null, $default = null) {
		
		$result = $default;
		
		//valid user
		if ($source && $properties && count($properties)>0) {
	
			//string separator
			$separator = ($separators && !is_array($separators) ? $separators : ' ');
	
			//add values
			$index = 0;
			foreach ($properties as $property) {
	
				//append property
				if (isset($source->$property) && strlen($source->$property)>0) {

					//append property
					if ($result && strlen($result)>0) {
						$result .= $separator . $source->$property;
					}
					
					//set property
					else {
						$result = $source->$property;
					}

				}
				
				//get separator (separator is not used for first entry)
				if ($separators && is_array($separators) && $index<count($separators)) {
					$separator = $separators[$index];	
				}
				
				//increment index
				++$index;
				
			} //end for()
			
			
			/*
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
			*/
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
		
		return $result;
		
	} //end compilePropertiesString()
	
?>