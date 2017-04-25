<?php

	//setup namespace
	use Carbon\Carbon;
	use Soup\Mobile\Models\VenueOpenHours;
	use Soup\Mobile\Models\VenueBlockedHours;


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
					'Y-d-m',
					'Y-d-m H:m:s'
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
						//echo "Exception - format[" . $format . "] - string[" . $dateString . "]: " . $ex->getMessage() . "<br>";
						continue;
					}
					
				} //end for()
				
				
				//no date found - try direct conversion
				if (!$date) {
					try {
						$date = new Carbon($dateString);	
					}
					catch (\Exception $ex) {
						$date = null;
					}
				}
				
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
	
	function venueOpenHoursString($venue, $default = null, $date = null) {
		
		$result = $default;
		
		//use default date (if required)
		if (!$date) {
			$date = Carbon::now();
		}
		
		//valid venue and date
		if ($venue && $date) {
		
			//get day of week
			$day = $date->format('l');
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
		
		} //end if (valid venue and date)
		
		return $result;
		
	} //end venueOpenHoursString()
	
	
	
	function availablityForRecommendation($recommendation, $venue = null, $startDate = null, $endDate = null) {
		
		$availableDates = null;
		
		//valid recommendation
		if ($recommendation) {
		
			//get venue if required
			if (!$venue || $venue->id!=$recommendation->venue) {
				$venue = $recommendation->venue();	
			}

			//valid venue
			if ($venue) {

				//get start date
				if (!$startDate) {
					$startDate = $recommendation->activation_date ? $recommendation->activation_date : Carbon::now();	
				}
	
				//get end date
				if (!$endDate) {
					$endDate = $recommendation->expiration_date ? $recommendation->expiration_date : Carbon::now()->addDays(30);
				}
				
				//get days venue is open
				$availability = VenueOpenHours::select(['day', 'open_time', 'close_time'])
											->where('venue', $venue->id)
		    								->whereNotNull('open_time')
		    								->where('open_time', '!=', '')
		    								->where('open_time', '<', 'close_time')
		    								->get();

				//venue is open
				if ($availability && count($availability)>0) {
				
				
					//limit hours by reservation type
					$startLimit = null;
					$endLimit = null;
					switch (strtolower($recommendation->type)) {
					
						case "dinner":
							$startLimit = Carbon::createFromFormat('H:i:s', '17:00:00');
						break;
						
						case "lunch":
							$startLimit = Carbon::parse('10:00:00');
							$endLimit = Carbon::parse('15:00:00');
						break;
						
						case "brunch":
							$endLimit = Carbon::parse('13:00:00');
						break;
						
						case "breakfast":
							$endLimit = Carbon::parse('11:00:00');
						break;
						
					} //end switch (recommendation type)
				
				
					//compile day availability times
					$days = [];
					$hours = null;
					$openTime = null;
					$closeTime = null;
					foreach ($availability as $day) {
						
						//get open time
						$openTime = $day->open_time;
						if ($openTime) {
							
							//get close time
							$closeTime = $day->close_time;
							if (!$closeTime) {
								$closeTime = $openTime->endOfDay();	
							}
							//prevent bookings for last hour (TODO: handle case where venue is open past midnight)
							else {
								$closeTime->subHour();
							}
							
							
							//limit hours by recommendation type
							if ($startLimit) {
								if ($openTime->lt($startLimit)) {
									$openTime = $startLimit;
								}
							}
							if ($endLimit) {
								if ($closeTime->gt($endLimit)) {
									$closeTime = $endLimit;
								}	
							}
	//echo "day[" . $day->day . "] type[" . $recommendation->type . "] openTime: " . print_r($openTime, true) . " - closeTime: " .  print_r($closeTime, true) . "<br><br>";

							//compile list of hours
							$hours = [];
							for ($date = $openTime->copy(); $date->lte($closeTime); $date->addMinutes(15)) {
								$hours[] = $date->format('g:i A');
							}
							
							//store hours list for day
							$days[$day->day] = $hours;

						} //end if (valid open time)

					} //end for()



					//get list of blocked dates
					$blockedDates = $venue->blockedHours()->get();

					//create dates list
					$availableDates = [];

					//add dates
					$day = null;
					$openTimes = null;
				    for($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
				    	
				    	//get date day of week
						$day = $date->format('l');
						if (!is_null($day) && strlen($day)>0) {
				    	
							//check if venue is open on specified day
							$openTimes = $days[$day];
							
							//has open times
							if ($openTimes && count($openTimes)>0) {

								//TODO: check for blocked times
								if ($blockedDates) {
								
									//get venue open times
									$startTime = Carbon::createFromFormat('Y-m-d g:i A', $date->format('Y-m-d ') . ($openTimes[0]));
									$endTime = Carbon::createFromFormat('Y-m-d g:i A', $date->format('Y-m-d ') . $openTimes[count($openTimes)-1]);
									
									//check for blocked dates
									foreach ($blockedDates as $blocked) {
										
										//end has dates
										if ($blocked->start_date && $blocked->end_date) {
											
											//within blocked dates
											if ($blocked->start_date->lte($startTime) && $blocked->end_date->gt($endTime)) {
											 	
											 	//TODO: compare hours - allow hours outside of times
											 	
											 	//clear open times
											 	$openTimes = null;
											 	break;
											}
											 
										} //end if (has dates)
										
									} //end for()
									
								} //end if (has blocked dates)
								
							} //end if (has open times)
								
					    	//venue is open on date
					    	if ($openTimes && count($openTimes)>0) {
					    	
						    	//add date and times
						    	$availableDates[] = ['date' => $date->copy(), 'times' => $openTimes]; 
					    	
					    	}
				    	
						} //end if (valid day)
				        
				    } //end for()
			    
				} //end if (venue is open)
		    
			} //end if (valid venue)
			
		} //end if (valid recommendation)

		return $availableDates;
		
	} //end availablityForRecommendation()
	
	
	
	
	
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
	
				//ARRAY SOURCE
				if (is_array($source)) {
					
					//append property
					if (isset($source[$property]) && strlen($source[$property])>0) {
	
						//append property
						if ($result && strlen($result)>0) {
							$result .= $separator . $source[$property];
						}
						
						//set property
						else {
							$result = $source[$property];
						}
	
					}
					
				}
				//OBJECT SOURCE
				else {
	
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
				
				}
				
				//get separator (separator is not used for first entry)
				if ($separators && is_array($separators) && $index<count($separators)) {
					$separator = $separators[$index];	
				}
				
				//increment index
				++$index;
				
			} //end for()
			
			
		} //end if (valid user)
		
		return $result;
		
	} //end compilePropertiesString()
	
?>