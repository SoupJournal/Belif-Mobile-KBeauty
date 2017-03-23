<?php

	namespace Soup\Mobile\Controllers;

	use Soup\Mobile\Controllers\BaseController;
	use Soup\Mobile\Models\SoupUser;
	use Soup\Mobile\Models\UserProfile;
	use Soup\Mobile\Lib\AppGlobals;
	
	use View;
	use Redirect;
	use Illuminate\Support\Facades\Auth;
	
	use Carbon\Carbon;

	class QuizController extends BaseController {
		

		//public function __construct() {
			

		//} //end constructor()
		
		
	
	
		//==========================================================//
		//====						QUIZ						====//
		//==========================================================//	
		
	
	
		public function getQuiz() {
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_QUIZ);
			//$pageData = $this->dataForFormId(self::FORM_QUIZ);
			
			//draw page
			return View::make('soup::pages.quiz.home')->with([
				'pageData'=> $pageData,
				'nextURL' => route('soup.question.id', ['questionId'=>0]),
				//'backURL' => route('soup.welcome')
			]);
			
		} //end getQuiz()
		
		
	
	
		
		public function getQuestion($questionId = 0) {
			
			
			//find user
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			
			//get page data
			$pageData = $this->questionsData();
//			$pageData = $this->dataForFormId(self::FORM_QUESTION);
			
			//determine total questions
			$totalQuestions = $this->questionsCount();
			//$totalQuestions = ($pageData ? count($pageData) : 0);
			
			//get current question id
			$activeId = activeQuestionNumber($user, $pageData);
			

//				echo "questionId: " . $questionId . " - totalQuestions: " . $totalQuestions . " - activeId: " . $activeId . " - groups: " . $this->questionGroupCount();
//				exit(0);
			//valid question ID
			if (($questionId<$totalQuestions || $questionId<$activeId) || ($activeId==$totalQuestions && $questionId>=$totalQuestions)) {
				
				//validate id
				if ($questionId<0) $questionId = 0;
				if ($questionId>$activeId) $questionId = $activeId; 
				
								
				//get question data
				$questionData = null;
				if ($questionId < count($pageData)) {
					$questionData = $pageData[$questionId];
				}
				
	
				//compile page data
				$viewParams = Array (
					'pageData'=> $questionData,
					'backURL' => $questionId > 0 ? route('soup.question.id', ($questionId-1)) : route('soup.quiz'),
					'formURL' => route('soup.question'),
					'totalSteps' => $this->questionGroupCount()
				);
	
	
				//get question type
				$questionType = safeArrayValue('type', $questionData, 0);
				
				//create view
				$view = null;
				switch ($questionType) {
					
					case AppGlobals::QUESTION_TYPE_TEXT:
						$view = 'soup::pages.quiz.text';
					break;
					
					case AppGlobals::QUESTION_TYPE_DROP_DOWN:
						$view = 'soup::pages.quiz.dropdown';
					break;
					
					case AppGlobals::QUESTION_TYPE_MULTIPLE:
						$view = 'soup::pages.quiz.multichoice';;
					break;
						
					//case AppGlobals::QUESTION_TYPE_BINARY:
					default:
						$view = 'soup::pages.quiz.question';
					break;
						
				} //end switch (question type)
	
	
				//valid view
				if ($view) {
				
					//draw page
					return View::make($view)->with($viewParams);
				
				}
				//no valid view
				else {
					return redirect(route('soup.quiz'));
				}
				
			
			
			}
			//all question completed
			else {
				return redirect(route('soup.quiz.thanks'));
			}
			
		} //end getQuestion()
		
		
		
		
		public function postQuestion() {
			
			$valid = true;
			
			//determine if data should be saved
			$saveValue = true;
			
			
			
			//get form values
			$key = safeArrayValue('key', $_POST);
			
			//handle secondary values
			$secondaryValue = safeArrayValue('secondaryValue', $_POST, null);
			$secondaryKey = null;

			//get answer value
			$value = safeArrayValue('value', $_POST, null);
			//check for value set by javascript 
			if ($value==null) {
				$value = safeArrayValue('scriptValue', $_POST, null);
			}


			//valid key
			if ($key && strlen($key)>0) {

				//get page data
				$pageData = $this->questionsData();
				//$pageData = $this->dataForFormId(self::FORM_QUESTION);
	
				//get question data
				$questionData = null;
				$questionId = $this->questionIdFromKey($key, $pageData);
				if ($questionId>=0 && $questionId<count($pageData)) {
					$questionData = $pageData[$questionId];
				}
				
				//determine total questions
				$totalQuestions = $this->questionsCount();
				//$totalQuestions = ($pageData ? count($pageData) : 0);
				
			
	
				//find user
				$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
				
				//valid user
				if (!$user || $user->status!=AppGlobals::USER_STATUS_MEMBER) {
					$errors = 'Sorry, missing or invalid user credentials. Please login or restart the signup proccess';
					$valid = false;
				}
	
				//valid question
				else if (!$questionData) {
					$errors = 'Opps, looks like an error occurred.';
					$valid = false;
				}
	
				//valid form
				else {
					
					//get question type
					$type = $questionData['type'];
					
						
					switch ($type) {
						
						case AppGlobals::QUESTION_TYPE_TEXT:
							$value = $value ? trim($value) : null;
						break;
						
						case AppGlobals::QUESTION_TYPE_DROP_DOWN:
						
						break;
					
						case AppGlobals::QUESTION_TYPE_MULTIPLE:
							$secondaryKey = $key . "_text";
							$secondaryValue = $secondaryValue ? trim($secondaryValue) : null;
						break;
						
						//case AppGlobals::QUESTION_TYPE_BINARY:
						default:
	
							//option selected
							if ($value>0) {
								$value = $questionData['options'];	
							}
							//option rejected
							else {
								$saveValue = false;	
							}
							
						break;
						
					} //end switch (type)
						
				
				}
				
				//valid form
				if ($valid) {

					//indicate question was answered
					$this->storeQuestionKey($key, $user);


					//clear existing answers
					$deleteQuery = $user->profile()->where('question', '=', $key);
					if ($secondaryKey && strlen($secondaryKey)>0) {
						$deleteQuery->orWhere('question', '=', $secondaryKey);
					}
					$profileValues = $deleteQuery->get();
					foreach ($profileValues as $profile) {
						$profile->delete();	
					}
					

					//save new values
					if ($saveValue) {

						//array value
						if (is_array($value)) {
							
							//store values
							foreach ($value as $val) {
								
								//store question answer
								$profile = new UserProfile();
								$profile->user = $user->id;
								$profile->question = $key;
								$profile->value = $val;
								$profile->save();
								
							} //end for()
							
						}
						//single value
						else {
						
							//store question answer
							$profile = new UserProfile();
							$profile->user = $user->id;
							$profile->question = $key;
							$profile->value = $value;
							$profile->save();
						
						}
						
						//store secondary value
						if ($secondaryKey && strlen($secondaryKey)>0) {
							
							//store secondary question answer
							$profile = new UserProfile();
							$profile->user = $user->id;
							$profile->question = $secondaryKey;
							$profile->value = $secondaryValue;
							$profile->save();
							
						}
						
					} //end if (save values)
						
						
					//get next question Id
					$nextId = ($questionId+1);
					

					//more questions
					if ($nextId<$totalQuestions) {
						
						//show next question
						return redirect()->route('soup.question.id', [
							'questionId' => $nextId
						]);
					
					}
					//quiz complete
					else {
	
						//store quiz state
						$user->quiz_complete = true;
						$user->save();
						
						return redirect()->route('soup.quiz.thanks');
					}
					
					
						
				}
			
			} //end if (valid key)
			
			//invalid key
			else {
				$errors = 'Opps, looks like an error occurred.';
				$valid = false;
			}
			
			
			
			//invalid form
			if (!$valid) {
				return Redirect::back()
							->withInput()
							->withErrors($errors);
			}
		
			
		} //end postQuestion()
		
			
			
			
	
		public function getThanks() {
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_QUIZ_THANKS);
			//$pageData = $this->dataForFormId(self::FORM_QUIZ_THANKS);
			
			//determine total questions
			$questionsData = $this->questionsData();
			$totalQuestions = $this->questionsCount();
			
			//find last question Id
			$lastQuestionId = $totalQuestions>1 ? $totalQuestions-1 : 0;
		
			
			//draw page
			return View::make('soup::pages.quiz.thanks')->with([
				'pageData'=> $pageData,
				'nextURL' => route('soup.quiz.complete'),
				'backURL' => route('soup.question.id', ['questionId' => $lastQuestionId])
			]);
			
		} //end getThanks()
			
			
			
			
			
		public function getCompleteQuiz() {
			
			return Redirect::route('soup.user.profile')->with(['showNext' => true]);
			//indicate next button should show on profile page
			//\Request::session()->set('showNext');
			
		} //end getCompleteQuiz()
			
			
			
			
			
		//==========================================================//
		//====					SERVICE METHODS					====//
		//==========================================================//	
			
			
			
			
		//==========================================================//
		//====					DATA METHODS					====//
		//==========================================================//	
						
		private function setQuestionResult($questionKey, $type, $value) {
			
		} //end setQuestionResult()
					
					
					
		
			
					
					
		private function questionIdFromKey($key, $questionsData) {
			
			$questionId = -1;

			//valid key
			if ($key && strlen($key)>0) {

				//valid data
				if ($questionsData) {

					//find matching key
					$index = 0;
					foreach ($questionsData as $data) {

						//found match
						if (strcmp($data['key'], $key)==0) {
							$questionId = $index;
							break;
						}
						
						//increment question Id
						++$index;
						
					} //end for()
				
				} //end if (valid data)
				
			} //end if (valid key)
			
			return $questionId;
			
		} //end questionIdFromKey()
			
			
			

		private function storeQuestionKey($key, $user) {
			
			//valid key
			if ($key && strlen($key)>0) {
				
				//valid user
				if ($user) {
					
					//decode array
					try {
						$storedQuestions = json_decode($user->answered_questions);	
						
						//data exists
						if ($storedQuestions && is_array($storedQuestions)) {
			
							//check if key stored
							if (!in_array($key, $storedQuestions)) {
								
								//add key
								array_push($storedQuestions, $key);
								
							}
								
						}
						//new array
						else {
							$storedQuestions = array($key);
						}
				
						//convert data
						$JSONdata = json_encode($storedQuestions);

						//save data
						$user->answered_questions = $JSONdata;
						$user->save();
						
					}
					catch (Exception $ex) {
						
					}
					
				} //end if (valid user)
				
			} //end if (valid key)
					
		} //end storeQuestionKey()
		
		
									
	} //end class SiteController


?>