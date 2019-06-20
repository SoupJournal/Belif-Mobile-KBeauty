<?php

	namespace Belif\Mobile\Controllers;
	
	use Belif\Mobile\Models\Question;
	use Belif\Mobile\Models\Product;

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
                    'headerLogoUrl' => $this->header_logo_url_black,
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
						'questionNumber' => $questionIndex,
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

			$answers = Session::get('answers');

			$step4a = ['A','A','A','A','A']; //
			$step4b = ['B','B','B','B','B']; //
            $step4c = ['C','C','C','C','C']; //
            $step4d = ['D','D','D','D','D']; //
            $step4e = ['E','E','E','E','E']; //

			$step4aCount = $step4bCount = $step4cCount = $step4dCount = $step4eCount = $idx = 0;

			foreach ($answers as $answer) {
				if ($answer == $step4a[$idx]) {
					$step4aCount++;
				}
				if ($answer == $step4b[$idx]) {
					$step4bCount++;
				}
                if ($answer == $step4c[$idx]) {
                    $step4cCount++;
                }
                if ($answer == $step4d[$idx]) {
                    $step4dCount++;
                }
                if ($answer == $step4e[$idx]) {
                    $step4eCount++;
                }
				$idx++;
			}

			$answerCounts = [
				'A' => $step4aCount,
				'B' => $step4bCount,
                'C' => $step4cCount,
                'D' => $step4dCount,
                'E' => $step4eCount,
			];
			
			$finalAnswer = array_search(max($answerCounts),$answerCounts);

			$themeColor = 1;

			$selectedProducts = [];
			if ($finalAnswer == 'A') {
				$sampleResult = self::FORM_RESULTS_A;
				$productIdx = 0;
				$selectedProducts[] = 1;
				$selectedProducts[] = 0;
				$headerLogoUrl = $this->header_logo_url_white;
			} elseif ($finalAnswer == 'B') {
				$sampleResult = self::FORM_RESULTS_B;
				$productIdx = 1;
				$selectedProducts[] = 2;
				$selectedProducts[] = 0;
                $headerLogoUrl = $this->header_logo_url_black;
            } elseif ($finalAnswer == 'C') {
                $sampleResult = self::FORM_RESULTS_C;
                $productIdx = 2;
                $selectedProducts[] = 3;
                $selectedProducts[] = 0;
                $headerLogoUrl = $this->header_logo_url_white;
            } elseif ($finalAnswer == 'D') {
                $sampleResult = self::FORM_RESULTS_D;
                $productIdx = 3;
                $selectedProducts[] = 4;
                $selectedProducts[] = 0;
                $headerLogoUrl = $this->header_logo_url_white;
            } elseif ($finalAnswer == 'E') {
                $sampleResult = self::FORM_RESULTS_E;
                $productIdx = 4;
                $selectedProducts[] = 5;
                $selectedProducts[] = 0;
                $headerLogoUrl = $this->header_logo_url_white;
            }

			Session::set('selectedProducts', $selectedProducts);

			//get page data
			$pageData = $this->dataForPage($sampleResult);
			
			//get background image
			$backgroundImage = safeArrayValue('background_image', $pageData);

			//get products
			$products = Product::where('available', true)->get();
		
			//render view
			return View::make('belif::pages.results')->with(Array (
				'pageName' => 'results',
				'pageData' => $pageData,
				'products' => $products,
				'productIdx' => $productIdx,
				'backgroundImage' => $backgroundImage,
				'backURL' => route('belif.question.previous'),
				'buttonURL' => route('belif.address'),
				'restartURL' => route('belif.tryagain'),
				'sampleResult' => $sampleResult,
                'headerLogoUrl' => $headerLogoUrl
			));
			
		} //end getResults()
			
		public function getProduct() {
			
			//get products
			$products = Product::where('available', true)->get();

			//get quiz results
			$results = $this->answerResults();

			//number of correct answers
			$correctAnswers = $this->correctAnswers($results);

			//get number of samples
			$numberOfSamples = $this->numberOfSamples(count($results), $correctAnswers);

			//get page data
			$pageData = $this->dataForPage(self::FORM_PRODUCTS);
			
			//get background image
			$backgroundImage = safeArrayValue('background_image', $pageData);
			
			//get previously selected products
			$selectedProducts = Session::get('selectedProducts');

			//render view
			return View::make('belif::pages.product')->with(Array (
				//'pageName' => 'product_' . $product,
				'pageData' => $pageData,
				'products' => $products,
				'numberOfSamples' => $numberOfSamples,
				'selectedProducts' => $selectedProducts,
				'backgroundImage' => $backgroundImage,
				'backgroundFill' => true,
				'formURL' => route('belif.product.submit'),
				'backURL' => route('belif.results')
			));
			
		} //end getProduct()
			
		public function postProduct() {
	
			$valid = true;
			$errors = null;
			
			//get form values
			$products = safeArrayValue('product', $_POST);
			
			//get number of available products
			$availableProducts = Product::where('available', true)->count();
			
			
			//find selected products
			$selectedProducts = [];
			if ($products) {
				
				foreach ($products as $key => $product) {
				
					//product is selected
					if (filter_var($product, FILTER_VALIDATE_BOOLEAN)) {
						$selectedProducts[] = $key;
					}
					
				} //end for()
				
			} //end if (found products)

			//get quiz results
			$results = $this->answerResults();

			//number of correct answers
			$correctAnswers = $this->correctAnswers($results);

			//get number of samples
			$numberOfSamples = $this->numberOfSamples(count($results), $correctAnswers);

			//number of selected products
			$numberOfSelectedProducts = count($selectedProducts);
			
			//no products selected
			if ((!$selectedProducts || $numberOfSelectedProducts<=0) && $availableProducts>0) {
				$errors = 'Please select the products you would like to sample.';
				$valid = false;
			}
			
			//not enough samples selected
			else if (($numberOfSelectedProducts<$numberOfSamples) && $numberOfSelectedProducts<$availableProducts) {
				
				//get number of unselected samples
				$unselected = $numberOfSamples - $numberOfSelectedProducts;
				
				$errors = 'You are entitled to select ' . $unselected . ' more sample' . ($unselected!=1?'s.':'.');
				$valid = false;
			}
			
			//too many samples selected
			else if ($numberOfSelectedProducts>$numberOfSamples || $numberOfSelectedProducts>$availableProducts) {	
				$errors = 'Sorry, you have selected too many samples.';
				$valid = false;
			}
			
			//store selected samples
			Session::set('selectedProducts', $selectedProducts);
			
			//valid form
			if ($valid) {
				
				//show unavailable
				return Redirect::route('belif.address');
				
			}
			//invalid form
			else {
				return Redirect::back()
							->withInput()
							->withErrors($errors);
							//->with('selectedProducts', $selectedProducts);
			}
			
		} //end postProduct()
			
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
			
		private function correctAnswers($results = null) {
			
			//get results if required
			if (!$results) {
				$results = $this->answerResults();
			}
			
			//determine number of correct answers
			$correctAnswers = 0;
			foreach ($results as $result) {
				if ($result) {
					++$correctAnswers;
				}
			}
			
			return $correctAnswers;
			
		} //end correctAnswers()
			
		private function numberOfSamples($numberOfQuestions, $correctAnswers) {
			
			$numberOfSamples = 0;
			
			//questions exist
			if ($numberOfQuestions>0) {
			
				//determine number of samples
				if ((floatval($correctAnswers) / $numberOfQuestions) > 0.75) {
					$numberOfSamples = 2;
				}
				else if ((floatval($correctAnswers) / $numberOfQuestions) > 0.35) {
					$numberOfSamples = 1;
				}
			
			}
			
			return $numberOfSamples;
			
		} //end numberOfSamples()
					
	} //end class ProductController
?>