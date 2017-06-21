<?php

	namespace Belif\Mobile\Controllers;


	use Belif\Mobile\Models\Page;
	//use Belif\Mobile\Models\Question;
	
	use Session;
	use App\Http\Controllers\Controller;


	class BaseController extends Controller {
		

		//page constants
		//const FORM_HOME = 'page_home';
		const FORM_EMAIL = 'page_email';
		const FORM_GUIDE = 'page_guide';
		const FORM_QUESTION = 'page_question';
		const FORM_ANSWER = 'page_answer';
		const FORM_RESULTS = 'page_results';
		const FORM_PRODUCTS = 'page_products';
		const FORM_ADDRESS = 'page_address';
		const FORM_VERIFY = 'page_verify';
		const FORM_SHARE = 'page_share';
		const FORM_THANKS = 'page_thanks';
		const FORM_NO_SAMPLES = 'page_unavailable';
		const FORM_UNSUBSCRIBE = 'page_unsubscribe';
		const FORM_DESKTOP = 'page_desktop';
		//const FORM_ERROR = 14;
		//data forms
		const FORM_IS_AVAILABLE = 'product_available';
		//products
		const PRODUCT_AQUA_BOMB = 1;
		const PRODUCT_MOISTURIZING_BOMB = 2;
		
		//verify email details
		const EMAIL_SENDER_VERIFY = 'team@belifinhydration.com';
		const EMAIL_SUBJECT_VERIFY = 'Verify your email to claim your gift.';
		
		//share email details
		const EMAIL_SENDER_SHARE = 'team@belifinhydration.com';
		const EMAIL_SUBJECT_SHARE = ' wants to give you the gift of belif.';
		
		//product email details
		const EMAIL_SENDER_PRODUCT = 'team@belifinhydration.com';
		const EMAIL_SUBJECT_PRODUCT = "Your sample is on its way!";
		
					
			
		
		//number of questions
		private $numberOfQuestions = 3;
		
		
		
		
		//catch all undefined request and route to home
		public function missingMethod($parameters = array()) {
			
			return Redirect::to('/');
			
		} //end missingMethod()
		
		
			
		
		//==========================================================//
		//====					DATA METHODS					====//
		//==========================================================//	
		
		
				
		
		protected function clearAnswers($clearIndex = 0) {
			
			//get current answers
			$answers = Session::get('answers');
			
			//clear remaining answers
			for ($i=$clearIndex; $i<=$this->numberOfQuestions; ++$i) {
				unset($answers[$i]);
			}
			
			//store answers
			Session::set('answers', $answers);
			
		} //end clearAnswers()
		
		
		
		
		
		protected function productAvailable($product = 0) {
			
			return true;
			
//			$available = false;
//			
//			//get availability data
//			$data = $this->dataForFormId(self::FORM_IS_AVAILABLE);
//			$available = $data && safeArrayValue('available', $data, false);
//			
//			return $available;
				
		} //end productAvailable()
		
		
		
		
		protected function getSelectedProducts() {
			
			//sum of question values (used to determine product)
			$productValue = 0;
			
			//get answers
			$answers = Session::get('answers');
			if ($answers) {
				
				//find product value
				$index = 0;
				foreach ($answers as $value) {
					
					//invert value for question 1
					if ($index==0) {
						$value = ($value==1 ? 0 : 1);	
					}
					
					//calculate value
					$productValue += $value;
					++$index;
					//echo "[" . $value . "]";
				}
			}
			//calculate product
			$product = self::PRODUCT_MOISTURIZING_BOMB;
			if ($productValue>=2) {
				$product = self::PRODUCT_AQUA_BOMB;
			}
			//echo "product: " . $product . " - value: " . $productValue;
			//exit(0);
			return $product;
	
		} //end getSelectedProducts()
		
		
		
		/*
		
		protected function questionsData() {
			
			//get questions data
			$questionsData = Question::where('status', 1)->orderBy('order')->get();
			if ($questionsData) {
				$questionsData = $questionsData->toArray();	
			}

			return $questionsData;
			
		} //end questionsData()
		
		
		
		protected function questionsCount() {
			
			return Question::where('status', 1)->count();
			
		} //end questionsCount()
		
		
		
		protected function questionGroupCount() {

			//select all groups (using count directly generates incorrect SQL)
			$groups = Question::where('status', 1)->groupBy('group')->get();
			
			return $groups ? count($groups) : 0;
			
		} //end questionGroupCount()
		
		*/
		
		
		
		
		/*
		protected function dataForPage($pageId) {
			
			$pageData = null;
			//echo "pageId: " . $pageId;
			//valid id
			if ($pageId && strlen($pageId)>0) {
				
				//find page and any children
				$pageData = Page::where('key', $pageId)->with('children')->first();
				if ($pageData) {
					$pageData = $pageData->toArray();
				}
				
			} //end if (valid id)
			
			return $pageData;
			
		} //end dataForPage()
		*/

				
		protected function dataForPage($pageKey) {
			
			$pageData = null;
			
			//valid key
			if ($pageKey && strlen($pageKey)>0) {
				
				//retrieve page data
				$data = Page::where('key', $pageKey)->first();
				if ($data) {
					$pageData = $data->toArray();	
				}
				
			} //end if (valid key)
			
			return $pageData;
			
			
			
			//retrieve data from database
			//$pageData = dataForForm($pageId);
			/*
			$pageData = null;
			
			switch($pageId) {
				
				case self::FORM_HOME:
				{
					$pageData = Array (
						"title" => "WHAT'S YOUR HYDRATION STYLE?",
						"subtitle" => "MOISTURIZING BOMB OR AQUA BOMB?",
						"text" => "Take our quiz and claim a free sample",
						"button" => "GET STARTED",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-001.jpg"
					);
				}
				break;
				
				case self::FORM_EMAIL:
				{
					$pageData = Array (
						"title" => "First we need your email:",
						"subtitle" => "You will be sent an email to verify this address.",
						"text" => "I want to unregister myself",
						"button" => "START",
						"button_cancel" => "I agree to the Terms & Conditions",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-002.jpg"
					);
				}
				break;
				
				case self::FORM_QUESTION_1:
				{
					$pageData = Array (
						"question" => "Which image represents your skin type the most?",
						"text" => "(Swipe Right or Left to answer)",
						"answer_A" => "Dry & Thirsty",
						"answer_B" => "Moist & Dewy",
						//"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-003.jpg",
						"image_A" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-003-left.jpg",
						"image_B" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-003-right.jpg",
						"theme"	=> 0
					);
				}
				break;
				
				case self::FORM_QUESTION_2:
				{
					$pageData = Array (
						"question" => "When thinking about your skin, which texture appeals to you the most?",
						//"text" => "(Swipe Right or Left to answer)",
						"answer_A" => "Leightweight gel-cream",
						"answer_B" => "Cushiony, whipped texture",
						//"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-004.jpg",
						"image_A" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-004-left.jpg",
						"image_B" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-004-right.jpg",
						"theme"	=> 1
					);
				}
				break;
				
				case self::FORM_QUESTION_3:
				{
					$pageData = Array (
						"question" => "So what are you really looking for?",
						//"text" => "(Swipe Right or Left to answer)",
						"answer_A" => "Burst of instant hydration",
						"answer_B" => "Explosion of long-lasting moisture",
						//"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-005.jpg",
						"image_A" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-005-left.jpg",
						"image_B" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-005-right.jpg",
						"theme"	=> 2
					);
				}
				break;
				
				case self::FORM_ANSWER_1:
				{
					$pageData = Array (
						"title" => "We think you'll LOVE True Cream Moisturizing Bomb!",
						"text" => "This comforting moisturizing cream provides skin with intense hydration, leaving it supple, smooth, and deeply nourished.",
						"button" => "Claim it!",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-006a.jpg"
					);
				}
				break;
				
				case self::FORM_ANSWER_2:
				{
					$pageData = Array (
						"title" => "We think you'll LOVE True Cream Aqua Bomb!",
						"text" => "This lightweight gel-cream floods skin with a rush of refreshing hydration and minimizes the apearance of pores for a soft, smooth, supple feel.",
						"button" => "Claim it!",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-006b.jpg"
					);
				}
				break;
				
				case self::FORM_ADDRESS:
				{
					$pageData = Array (
						"title" => "We need your address to send the gift to you!",
						"button" => "CLAIM GIFT",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-002.jpg"
					);
				}
				break;
				
				case self::FORM_VERIFY:
				{
					$pageData = Array (
						"title" => "Yay! You're one step closer to happy, hydrated skin!",
						"subtitle" => "Check your email for a link to verify your email and address.",
						"text" => "Once your email is verified we'll start preparing the delivery of your sample",
						"button" => "Didn't receive a verification email??<br>Click here to resend.",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-008.png"
					);
				}
				break;
				
				case self::FORM_SHARE:
				{
					$pageData = Array (
						"title" => "Want to give the gift of belif to a friend?",
						"subtitle" => "Send this quiz to a friend for a chance to win a skincare kit worth $250.",
						"text" => "Share the belif love and send this quiz to a friend for the chance to win a skincare kit worth $250.",
						"button" => "Share with a friend",
						"button_cancel" => "No thanks! I hate free stuff",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-007.jpg"
					);
				}
				break;
				
				case self::FORM_THANKS:
				{
					$pageData = Array (
						"title" => "Your a great friend!<br>We sent your friend an invitation to take the auiz and claim a sample",
						"subtitle" => "You're also entered into the draw to win $250 worth of belif products!",
						"text" => "Follow us on instagram for updates on the winner!",
						"button" => "follow belif",
						"button_cancel" => "No, I don't want to know if I win.",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-008.png"
					);
				}
				break;
				
			}
			
			return $pageData;
			*/
		} //end dataForPage()
		

					
	} //end class BaseController


?>