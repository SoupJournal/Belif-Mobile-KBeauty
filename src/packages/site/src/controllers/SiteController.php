<?php

	namespace Soup\Mobile\Controllers;

	//use Soup\CMS\Lib\BaseCMSController;
	
	use View;
	use App\Http\Controllers\Controller;

	class SiteController extends Controller {
		

		//page constants
		const FORM_WELCOME = 'page_home';
		const FORM_HOME = 'page_home';
		const FORM_QUESTION_1 = 'page_question_1';

		


		//public function __construct() {
			

		//} //end constructor()
		
		

		
		public function getIndex() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_WELCOME);
			
			//draw page
			return View::make('soup::pages.home')->with([
				'pageData' => $pageData,
				'nextURL' => route('soup.question'),
				'nextLabel' => 'login',
				'alternateHeader' => true
			]);
			
		} //end getIndex()
	
	
	
	
		
		public function getQuestion() {
			
			//get page data
			$pageData = $this->dataForFormId(self::FORM_QUESTION_1);
			
			//draw page
			return View::make('soup::pages.question')->with([
				'pageData'=> $pageData,
				'backURL' => route('soup.welcome')
			]);
			
		} //end getQuestion()
		
		
		
			
			
		//==========================================================//
		//====					SERVICE METHODS					====//
		//==========================================================//	
		
			/*
			
		public function getApplications() {
			
			
			//build query
			$query = CMSApp::select(['id', 'name'])->where('status', '=', 1);
			
			//get paginated results
			$results = $this->paginateRequestQuery($query, $_GET);
			
			//return paginated query
			return Response::json($results);
			
			
		} //end getApplications()
			
			
			
		public function postApplicationid($appID = null) {
			
			
		} //end postApplicationid()
		
		*/
		
			
			
			
		
		//==========================================================//
		//====					DATA METHODS					====//
		//==========================================================//	
		
			
		private function dataForFormId($pageId) {
			
			//retrieve data from database
			//$pageData = dataForForm($pageId);
			
			$pageData = null;
			switch($pageId) {
				
				case self::FORM_WELCOME:
				{
					$pageData = Array (
						"title" => "DISCOVER BETTER BREAKFASTS, LUNCH, DINNER AND DRINKS FROM YOUR NEW FAVOURITE CAFES, RESTAURANTS AND NIGHTLIFE EVERY MONTH.",
						//"subtitle" => "MOISTURIZING BOMB OR AQUA BOMB?",
						//"text" => "Take our quiz and claim a free sample",
						"button" => "SIGN UP",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-001.jpg"
					);
				}
				break;
				
				
				case self::FORM_QUESTION_1:
				{
					$pageData = Array (
						"question" => "WHERE IS YOUR FAVOURITE PART OF TOWN TO GET #EEEATS?",
						"text" => "(Swipe Right or Left to answer)",
						"answer" => "SOUTH BROOKLYN",
						"background_image" => "https://s3.amazonaws.com/soup-journal-app-storage/belif/mobile/images/page-003.jpg",
						"theme"	=> 0
					);
				}
				break;
				
				
			} //end switch()
			
			return $pageData;
			
		} //end dataForPageId()
			
					
	} //end class SiteController


?>