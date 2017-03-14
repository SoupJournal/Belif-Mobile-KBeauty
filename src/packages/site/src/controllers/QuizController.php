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
			$pageData = $this->dataForFormId(self::FORM_QUIZ);
			
			//draw page
			return View::make('soup::pages.quiz.home')->with([
				'pageData'=> $pageData,
				'nextURL' => route('soup.question'),
				//'backURL' => route('soup.welcome')
			]);
			
		} //end getQuiz()
		
		
	
	
		
		public function getQuestion($questionId = 0) {
			
			
			//find user
			$user = Auth::guard(AppGlobals::$AUTH_GUARD)->user();
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_QUESTION);
			
			//determine total questions
			$totalQuestions = ($pageData ? count($pageData) : 0);
			
			//get current question id
			$activeId = $this->activeQuestionNumber($user, $pageData);
			
			//valid question ID
			if ($activeId<$totalQuestions) {
				
	//		echo "activeId: " . $activeId . " - questionId: " . $questionId . "<BR>";
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
					'totalSteps' => 8
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
			
			//get form values
			$key = safeArrayValue('key', $_POST);
			//$type = safeArrayValue('type', $_POST);
			$value = safeArrayValue('value', $_POST);


			//valid key
			if ($key && strlen($key)>0) {

				//get page data
				$pageData = $this->dataForFormId(self::FORM_QUESTION);
	
				//get question data
				$questionData = null;
				$questionId = $this->questionIdFromKey($key, $pageData);
				if ($questionId>=0 && $questionId<count($pageData)) {
					$questionData = $pageData[$questionId];
				}
				
				//determine total questions
				$totalQuestions = ($pageData ? count($pageData) : 0);
				
			
	
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
						
						case AppGlobals::QUESTION_TYPE_DROP_DOWN:
	
						break;
					
						case AppGlobals::QUESTION_TYPE_MULTIPLE:
		
						break;
						
						//case AppGlobals::QUESTION_TYPE_BINARY:
						default:
	
						break;
						
					} //end switch (type)
						
				
				}
				
				//valid form
				if ($valid) {
					
					//clear existing answers
					$profileValues = UserProfile::where('question', '=', $key)->get();
					foreach ($profileValues as $profile) {
						$profile->delete();	
					}
					
					//store question answer
					$profile = new UserProfile();
					$profile->user = $user->id;
					$profile->question = $key;
					$profile->value = $value;
					$profile->save();
					
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
			$pageData = $this->dataForFormId(self::FORM_QUIZ_THANKS);
			
			//determine total questions
			$questionsData = $this->dataForFormId(self::FORM_QUESTION);
			$totalQuestions = ($questionsData ? count($questionsData) : 0);
			
			//find last question Id
			$lastQuestionId = $totalQuestions>1 ? $totalQuestions-1 : 0;
			
			
			//draw page
			return View::make('soup::pages.quiz.thanks')->with([
				'pageData'=> $pageData,
				'nextURL' => route('soup.question'),
				'backURL' => route('soup.question.id', ['questionId' => $lastQuestionId])
			]);
			
		} //end getThanks()
			
			
			
		//==========================================================//
		//====					SERVICE METHODS					====//
		//==========================================================//	
			
		//==========================================================//
		//====					DATA METHODS					====//
		//==========================================================//	
						
		private function setQuestionResult($questionKey, $type, $value) {
			
		} //end setQuestionResult()
					
					
					
		
					
					
					
		private function activeQuestionNumber($user, $questionsData) {
			
			$questionId = 0;
			
			//valid data
			if ($user && $questionsData && count($questionsData)>0) { 
				
				//get profile data
				$profiles = $user->profile()->groupby('question')->get();
	
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
							if (strcmp($question['key'], $profile['question'])==0) {
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
					
					//all questions answered
//					if ($foundAnswer) {
//						$questionData = null;
//					}
				
				}
				
			} //end if (valid data)
			
			return $questionId;
			
		} //end activeQuestionNumber()
					
					
					
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
			
			
			
			/*
		private function previousQuestionData($currentKey, $questionsData) {
			
			$questionData = null;
			
			//valid data
			if ($currentKey && $questionsData && strlen($currentKey)>0 && count($questionsData)>0) {
				
				//find question
				foreach ($questionsData as $question) {
					
					//match found
					if (strcmp($question['key'], $profile['question'])==0) {
						break;
					}
					//no match (store as previous data)
					else {
						$questionData = $question;
					}
					
				} //end for()
				
			} //end if (valid data)
			
			return $questionData;
			
		} //end previousQuestionData()
			
				
				
						
		private function activeQuestionData($user, $questionsData) {
			
			$questionData = null;


			//valid data
			if ($user && $questionsData && count($questionsData)>0) { 
				
				//get profile data
				$profiles = $user->profile()->groupby('question')->get();
	
				//found profile data
				if ($profiles && count($profiles)>0) {

					//find question data
					$foundAnswer = false;
					foreach ($questionsData as $question) {
		
						//store question data
						$questionData = $question;

	
						//reset answer state
						$foundAnswer = false;
						
						//check if question answered
						foreach ($profiles as $profile) {

							//question was answered
							if (strcmp($question['key'], $profile['question'])==0) {
								$foundAnswer = true;
								break;
							}
							
						} //end for()
						
						//no match found
						if (!$foundAnswer) {
							break;
						}
						
					} //end for()
					
					//all questions answered
					if ($foundAnswer) {
						$questionData = null;
					}
				
				}
				//no profile data
				else {
					$questionData = $questionsData[0];
				}
				
			} //end if (valid data)

			return $questionData;
			
		} //end activeQuestionData()
				*/		
							
	} //end class SiteController


?>