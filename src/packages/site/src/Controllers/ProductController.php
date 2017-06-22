<?php

	namespace Belif\Mobile\Controllers;
	

	use Belif\Mobile\Models\Question;
	use Belif\Mobile\Controllers\BaseController;
	

	use View;
	use Session;
	use Redirect;
	

	class ProductController extends BaseController {
		
		

		
		public function __construct() {
	/*		
			//only allow mobile devices
			$this->beforeFilter('MobileOnly', array(
				'except' => array ('getDesktop')
			));
			
			
			
			//add filter (require email address - post email pages)
			$this->beforeFilter('Email', array(
				'except' => array ('getDesktop', 'getIndex', 'getEmail', 'postEmail', 'getShare', 'postShare', 'getThanks', 'getUnsubscribe', 'getResend')
			));	
			
			
			//add filter (require user Id - post verify pages)
			$this->beforeFilter('UserId', array(
				'only' => array ('postShare', 'getThanks')
			));
			*/
			
		} //end constructor()
		
		
		
		
		
		//==========================================================//
		//====					PAGE METHODS					====//
		//==========================================================//	
		


		public function getQuestion() {

			//get question index
			$questionIndex = $this->currentQuestionIndex();


			//get question data
			$questionData = $this->questionData($questionIndex);

			//convert to integer value
			//$question = intval($question);

//			//valid question id
//			$question = is_int($question) && $question>0 ? $question : 1;
//
//			//get question data
//			$questionData = Question::orderBy('order')
//								->orderBy('id')
//								->offset($question-1) //adjust question to start at 0 not 1
//								->limit(1)
//								->first();

			//valid question
			if ($questionData) {

				//convert question data
				//$questionData = $questionData->toArray();

				//get page data
				$pageData = parent::dataForPage(self::FORM_QUESTION);
				
				//get background image
				$backgroundImage = safeArrayValue('question_background_image', $questionData);
	

				//render view
				return View::make('belif::pages.question')->with(Array (
					'pageName' => 'question_' . $questionIndex,
					'pageData' => $pageData,
					'questionData' => $questionData,
					'questionNumber' => $questionIndex,
					'backgroundImage' => $backgroundImage,
					'buttonURL' => route('belif.answer'),
					'backURL' => $questionIndex>1 ? route('belif.question.previous') : route('belif.guide')
				));
			
			} //end if (valid question)
			
			//assume all questions answered
			return Redirect::route('belif.results');


		} //end getQuestion()
		
		
		
		public function getPreviousQuestion() {
			
			//get question index
			$questionIndex = $this->currentQuestionIndex();
			
			//previous question exists
			if ($questionIndex>1) {
				
				//get stored answers
				$answers = Session::get('answers');
				
				//clear last answer
				$answers[$questionIndex-1] = null;
				
				//store updated answers
				Session::set('answers', $answers);
				
				
				//show last question (also clears GET paramaters)
				return Redirect::route('belif.question');
				
			}
			
			//no previous question
			else {
				return Redirect::route('belif.guide');
			}
			
			
		} //end getPreviousQuestion()
		
		
					
			
		public function getAnswer() {
			
			//check if returning to previous question
//			$previousValue = safeArrayValue('previous', $_GET, 'false');
//			$usePrevious = filter_var($previousValue, FILTER_VALIDATE_BOOLEAN);
			//$previousValue = Request::session()->get('previous');
			
			
			//get question index
			$questionIndex = $this->currentQuestionIndex();
			
			
//			//determine question id
//			$questionIndex = 1;
//			
//			//get stored answers
//			$answers = Session::get('answers');
//			if ($answers) {
//				
//				//find first unanwsered question
//				while (safeArrayValue($questionId, $answers, null)!=null) {
//					++$questionIndex;
//				}
//			}
			
			/*
			//use previous question
			if ($usePrevious) {
				
				//move to last question
				--$questionIndex;
				
				//clear last question value
				if ($questionIndex>0) {
					
					//clear value
					unset($answers[$questionIndex]);
					
					//store answers
					Session::set('answers', $answers);
					
					//redirect to question page (removes get parameters from URL so refreshing the page trigger a back action)
					return Redirect::to('/question');
					
				}
					
			}
			*/
			
			//valid question id
			if ($questionIndex>0) {
			
				//get number of questions
				$numberOfQuestions = Question::count('id');
			
				//all questions answered
				if ($questionIndex>$numberOfQuestions) {
					
					//show product
					return Redirect::route('belif.product');
					
				}
				//show question
				else {
			
					//get question data
					$questionData = $this->questionData($questionIndex);

					//get page data
					$pageData = $this->dataForPage(self::FORM_ANSWER);
		
					//get background image
					$backgroundImage = safeArrayValue('answer_background_image', $questionData);
					
					//render view
					return View::make('belif::pages.answer')->with(Array (
						'pageName' => 'answer_' . $questionIndex,
						'pageData' => $pageData,
						'questionData' => $questionData,
						'backgroundImage' => $backgroundImage,
						'backURL' => route('belif.question', ['previous' => true]),
						'formURL' => route('belif.answer.id', ['questionIndex' => $questionIndex])
						//'questionId' => $questionId
					));
					
				
				} //end else (show question)
				
			} //end if (valid question id)
			
			//invalid request
			return Redirect::route('belif.email');
			
		} //end getAnswer()
			
			
			
			
			
		public function postAnswer($questionIndex = null) {
		
			//valid question id
			if ($questionIndex>0) {
			
				//get answer
				$value = safeArrayValue('value', $_POST, null);
						
				
				//valid answer
				if ($value!=null) {
					
					//store question answer
					$this->setAnswer($questionIndex, $value);
					
					
					//get number of questions
					$numberOfQuestions = Question::count('id');
				
					//move product
					if ($questionIndex>=$numberOfQuestions) {
						return Redirect::route('belif.results');
					}
					//move to next question
					else {
						return Redirect::route('belif.question');
					}
					
				}
				
				//question not answered
				return Redirect::back();
			
			} //end if (valid question id)
			
			
			//no question specified
			return Redirect::route('belif.home');
			
			
		} //end postAnswer()
		
			
			
			
		
		public function getResults() {

			//get quiz results
			$results = $this->answerResults();

			//get page data
			$pageData = $this->dataForPage(self::FORM_RESULTS);
			
			//get background image
			$backgroundImage = safeArrayValue('background_image', $pageData);
		
			//render view
			return View::make('belif::pages.results')->with(Array (
				'pageName' => 'results',
				'pageData' => $pageData,
				'results' => $results,
				'backgroundImage' => $backgroundImage,
				'backURL' => route('belif.question.previous'),
				'buttonURL' => route('belif.product'),
				'restartURL' => route('belif.guide')
			));
			
		} //end getResults()
		
		
		
			
			
		public function getProduct() {
			
			//calculate product
			//$product = $this->getSelectedProduct();
			
			//get page data
			$pageData = $this->dataForPage(self::FORM_PRODUCTS);
			
			//get background image
			$backgroundImage = safeArrayValue('background_image', $pageData);
		
			//render view
			return View::make('belif::pages.product')->with(Array (
				//'pageName' => 'product_' . $product,
				'pageData' => $pageData,
				'backgroundImage' => $backgroundImage,
				'buttonURL' => route('belif.address'),
				'backURL' => route('belif.results')
			));
			
		} //end getProduct()
			
			
					
			
			
					
			
			
		//==========================================================//
		//====					QUESTION METHODS				====//
		//==========================================================//	
		
		
		private function setAnswer($questionIndex, $value) {
			
			//valid question ID
			if ($questionIndex>0) {
			
				//get current answers
				$answers = Session::get('answers');
				if (!$answers) {
					$answers = array();
				}
				
				//set answer
				$answers[$questionIndex] = $value;
				
				//store answers
				Session::set('answers', $answers);
	
				//clear remaining answers
				$this->clearAnswers($questionIndex+1);
						
			} //end if (valid question ID)
			
		} //end setAnswer()
		
		
		
		
		
		private function answerResults() {
			
			$results = [];
			
			//get questions data
			$questionData = Question::orderBy('order')
									->orderBy('id')
									->get();	

			//found questions
			if ($questionData && count($questionData)>0) {
			
				//get current answers
				$answers = Session::get('answers');
				if (!$answers) {
					$answers = array();
				}
		
				//compile results
				$index = 1;
				foreach ($questionData as $question) {

					//get answer value
					$answer = safeArrayValue($index, $answers, null); //$index<count($answers) ? $answers[$index] : null;
					if (isset($answer)) {

						//set result
						$results[$index] = safeObjectValue('correct_answer', $question, null) == $answer;
						
					}
					//no answer found
					else {
						$results[$index] = false;
					}
					
					//increment index
					++$index;
					
				} //end for()
			
			} //end if (found questions)

			return $results;
			
		} //end answerResults()
		
		
		
		
		
		
		
		//==========================================================//
		//====					EMAIL METHODS					====//
		//==========================================================//
		
				
		
		/*
		private function sendProductEmail($user) {
			
			$result = false;
			
			//valid user
			if ($user && $user->email && strlen($user->email)>0) {
				
				//generate and store unique code
				$this->generateVerifyCode($user);
				
				
				//valid code
				if ($user->verify_code && strlen($user->verify_code)>0) { 
				
				
					//compile last address line
					$address3 = $user->city;
					if ($user->state && strlen($user->state)>0) {
						$address3 .= strlen($address3)>0 ? ', ' . $user->state : $user.state;
					}
					if ($user->zip_code && strlen($user->zip_code)>0) {
						$address3 .= strlen($address3)>0 ? ', ' . $user->zip_code : $user.zip_code;
					}
					
					
					//create view parameters
					$viewParams = Array(
						'unsubscribeLink' => URL::to('/unsubscribe?code=' . $user->verify_code)
					);
					
					//create email view
					$view = null;
					if ($user->product==1) {
						$view = View::make('belif::email.product1')->with($viewParams);
					}
					else {
						$view = View::make('belif::email.product2')->with($viewParams);	
					}
					
					//valid view
					if ($view) {
					
						//create headers
						$headers = "MIME-Version: 1.0\r\n"
								 . "Content-type: text/html;charset=UTF-8\r\n"
								 . "From: " . self::EMAIL_SENDER_PRODUCT . "\r\n";
						
						//send email through sendmail
						$result = mail($user->email, self::EMAIL_SUBJECT_PRODUCT, $view->render(), $headers);	
						
					} //end if (valid view)
				
				} //end if (valid code)
				
			} //end if (valid user)
		
	
			return $result;
			
		} //end sendProductEmail()
		*/
		
		
		
		
		
		//==========================================================//
		//====					DATA METHODS					====//
		//==========================================================//
		
		
		
		private function currentQuestionIndex() {
		
			//determine question id
			$questionIndex = 1;
			
			//get stored answers
			$answers = Session::get('answers');
			if ($answers) {
				
				//find first unanwsered question
				while (safeArrayValue($questionIndex, $answers, null)!=null) {
					++$questionIndex;
				}
			}	

			return $questionIndex;
			
		} //end currentQuestionIndex()
		
		
		
		
		private function questionData($questionIndex) {
		
			//valid question index
			$questionIndex = is_int($questionIndex) && $questionIndex>0 ? $questionIndex : 1;

			//get question data
			$questionData = Question::orderBy('order')
								->orderBy('id')
								->offset($questionIndex-1) //adjust question to start at 0 not 1
								->limit(1)
								->first();	
								
			//convert question data
			$questionData = $questionData ? $questionData->toArray() : null;
								
			return $questionData;
			
		} //end questionData()
		
		
		
					
	} //end class ProductController
?>