<?php

	namespace Belif\Mobile\Controllers;
	
	use Belif\Mobile\Models\Question;
	use Belif\Mobile\Models\Product;

    use Belif\Mobile\Models\User;
    use View;
	use Session;
	use Redirect;

	class ProductController extends BaseController {
		
		//==========================================================//
		//====					PAGE METHODS					====//
		//==========================================================//	

		public function getRetry() {
			
			$this->clearAnswers();

			return Redirect::route('belif.question');

		}

		public function getQuestion() {

			//get question index
			$questionIndex = $this->currentQuestionIndex();

			//get question data
			$questionData = $this->questionData($questionIndex);

			//valid question
			if ($questionData) {

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
                    'formURL' => route('belif.answer.id', ['questionIndex' => $questionIndex]),
                    'headerLogoUrl' => $this->header_logo_url_white,
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
			
			//get question index
			$questionIndex = $this->currentQuestionIndex();
			
			//valid question id
			if ($questionIndex > 0) {
			
				//get number of questions
				$numberOfQuestions = Question::count('id');
			
				//all questions answered
				if ($questionIndex > $numberOfQuestions) {
					
					// show results
					return Redirect::route('belif.results');
					
				}
				// show question
				else {
			
					// get question data
					$questionData = $this->questionData($questionIndex);

					// get page data
					$pageData = $this->dataForPage(self::FORM_ANSWER);
		
					// get background image
					$backgroundImage = safeArrayValue('answer_background_image', $questionData);

					//render view
					return View::make('belif::pages.answer')->with(Array (
						'pageName' => 'answer_' . $questionIndex,
						'pageData' => $pageData,
						'questionData' => $questionData,
						'questionNumber' => $questionIndex,
						'backgroundImage' => $backgroundImage,
                        'headerLogoUrl' => $this->header_logo_url_white,
						'backURL' => route('belif.question', ['previous' => true]),
						'formURL' => route('belif.answer.id', ['questionIndex' => $questionIndex])
					));
				
				} //end else (show question)
				
			} //end if (valid question id)
			
			//invalid request
			return Redirect::route('belif.email');
			
		} //end getAnswer()
			
		public function postAnswer($questionIndex = null) {
		
			// valid question id
			if ($questionIndex > 0) {
			
				// get answer
				$value = safeArrayValue('value', $_POST, null);

				// valid answer
				if ($value != null) {
					
					// store question answer
					$this->setAnswer($questionIndex, $value);

					// get number of questions
					$numberOfQuestions = Question::count('id');

					// move product
					if ($questionIndex >= $numberOfQuestions) {

                        // show results
                        return Redirect::route('belif.results');
					}
					// move to next question
					else {
						return Redirect::route('belif.question');
					}
					
				}
				
				// question not answered
				return Redirect::back();
			
			} // end if (valid question id)
			
			// no question specified
			return Redirect::route('belif.home');
			
		} //end postAnswer()
		
		public function getResults()
        {
            $products = Product::all();

            $answers = Session::get('answers');

            $sampleCount = 0;
            $availableSamples = [];
            $unavailableSamples = [];
            $productCount = 0;
            foreach($answers as $answer) {
                $product = $products[$productCount];
                if ($answer == 'A') {
                    $sampleCount++;

                    // is this sample available
                    if ($product->available_quantity < 1 || $product->available == 0) {
                        $unavailableSamples[] = $product->name;
                        $answers[($productCount + 1)] = 'F';
                    } else {
                        $availableSamples[] = $product->name;
                    }
                }
                $productCount++;
            }

            $sampleResult = self::FORM_RESULTS_A;
            $resultImage = 'results_a';

            if ($sampleCount == 0 || count($unavailableSamples) == 3) { // 0
                $sampleResult = self::FORM_RESULTS_A;
                $resultImage = 'results_a';
            } elseif ($sampleCount == 3 && count($unavailableSamples) == 0) { // 3
                $sampleResult = self::FORM_RESULTS_B;
                $resultImage = 'results_b';
            } elseif ($answers[1] == 'A' && $answers[2] == 'F' && $answers[3] == 'F') { // 1
                $sampleResult = self::FORM_RESULTS_C;
                $resultImage = 'results_d';
            } elseif ($answers[1] == 'F' && $answers[2] == 'A' && $answers[3] == 'F') { // 1
                $sampleResult = self::FORM_RESULTS_D;
                $resultImage = 'results_c';
            } elseif ($answers[1] == 'F' && $answers[2] == 'F' && $answers[3] == 'A') { // 1
                $sampleResult = self::FORM_RESULTS_E;
                $resultImage = 'results_e';
            } elseif ($answers[1] == 'A' && $answers[2] == 'A' && $answers[3] == 'F') { // 2
                $sampleResult = self::FORM_RESULTS_F;
                $resultImage = 'results_f';
            } elseif ($answers[1] == 'A' && $answers[2] == 'F' && $answers[3] == 'A') { // 2
                $sampleResult = self::FORM_RESULTS_G;
                $resultImage = 'results_h';
            } elseif ($answers[1] == 'F' && $answers[2] == 'A' && $answers[3] == 'A') { // 2
                $sampleResult = self::FORM_RESULTS_H;
                $resultImage = 'results_g';
            }

            $alternativeTitle = '';
            if (count($unavailableSamples) > 0) {
                $alternativeTitle = 'You’ve found ';
                if ($sampleCount == 3) {
                    $alternativeTitle .= 'three products and will be receiving FREE samples of ';
                    $alternativeTitle .= implode(' and ', $availableSamples);
                    $alternativeTitle .= ' but we have unfortunately run out of ';
                    $alternativeTitle .= implode(' and ', $unavailableSamples);
                } elseif ($sampleCount == 2) {
                    $alternativeTitle .= 'two products and will be receiving FREE samples of ';
                    $alternativeTitle .= implode(' and ', $availableSamples);
                    $alternativeTitle .= ' but we have unfortunately run out of ';
                    $alternativeTitle .= implode(' and ', $unavailableSamples);
                } elseif ($sampleCount == 1) {
                    $alternativeTitle .= 'one product but we have unfortunately run out of ';
                    $alternativeTitle .= implode(' and ', $unavailableSamples);
                }
            }

            // store email
            $email = Session::get('email');

            // find existing user
            $user = User::where('email', $email)->first();

            // save result for later
            $user->answers = implode(',', $answers);
            $user->all_answers = implode(',', $answers);
            $user->save();

            //get page data
            $pageData = $this->dataForPage($sampleResult);

            //get background image
            $backgroundImage = safeArrayValue('background_image', $pageData);

            return View::make('belif::pages.results')->with(Array (
                'pageName' => 'results',
                'pageData' => $pageData,
                'backgroundImage' => $backgroundImage,
                'headerLogoUrl' => $this->header_logo_url_white,
                'restartURL' => route('belif.tryagain'),
                'sampleResult' => $sampleResult,
                'resultImage' => $resultImage,
                'alternativeTitle' => $alternativeTitle
            ));

		} //end getResults()
			
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