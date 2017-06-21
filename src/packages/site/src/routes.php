<?php



	//==========================================================//
	//====						PATTERNS					====//
	//==========================================================//


	//pattern regex
	$safeStringPattern = '[0-9a-zA-Z_\-]+';
	
	//patterns
	Route::pattern('safestr', $safeStringPattern);
	Route::pattern('safestr2', $safeStringPattern);
	Route::pattern('id', '[0-9]+');
	


	//==========================================================//
	//====						CMS ROUTING					====//
	//==========================================================//	
	
	
	//group controllers into namespace
	Route::group(array('namespace' => 'Belif\Mobile\Controllers', 'middleware' => ['web'/*, 'HTTPS'*/]), function() {
	
		//desktop only access
		Route::group(array('middleware' => 'AppDesktop'), function() {
	
			//desktop
			Route::get('/desktop', ['as' => 'belif.desktop', 'uses' => 'MainController@getDesktop']);
		
		});
	
	
		//mobile only access
		//Route::group(array('middleware' => 'AppMobile'), function() {
	
			//welcome
			//Route::get('/', ['as' => 'belif.welcome', 'uses' => 'MainController@getIndex']);
			
			//email
			Route::get('/', ['as' => 'belif.home', 'uses' => 'MainController@getEmail']);
			//Route::get('/email', ['as' => 'belif.email', 'uses' => 'MainController@getEmail']);
			Route::post('/email', ['as' => 'belif.email', 'uses' => 'MainController@postEmail']);
			
			//guide
			Route::get('/guide', ['as' => 'belif.guide', 'uses' => 'MainController@getGuide']);

			//question
			Route::get('/question', ['as' => 'belif.question', 'uses' => 'ProductController@getQuestion']);		
			Route::get('/previousquestion', ['as' => 'belif.question.previous', 'uses' => 'ProductController@getPreviousQuestion']);		
			Route::get('/answer', ['as' => 'belif.answer', 'uses' => 'ProductController@getAnswer']);	
			Route::post('/answer/{id}', ['as' => 'belif.answer.id', 'uses' => 'ProductController@postAnswer']);	
			
			//results
			Route::get('/results', ['as' => 'belif.results', 'uses' => 'ProductController@getResults']);
			
			//product
			Route::get('/product', ['as' => 'belif.product', 'uses' => 'ProductController@getProduct']);
			
			//address
			Route::get('/address', ['as' => 'belif.address', 'uses' => 'MainController@getAddress']);
			Route::post('/address', ['as' => 'belif.address', 'uses' => 'MainController@postAddress']);
			
			//verfication
			Route::get('/verify', ['as' => 'belif.verify', 'uses' => 'MainController@getVerify']);
			Route::get('/reverify', ['as' => 'belif.reverify', 'uses' => 'MainController@getReverify']);
			
			//unavailable
			Route::get('/unavailable', ['as' => 'belif.unavailable', 'uses' => 'MainController@getUnavailable']);
			
			//share
			Route::get('/share', ['as' => 'belif.share', 'uses' => 'MainController@getShare']);			
			Route::post('/share', ['as' => 'belif.share', 'uses' => 'MainController@postShare']);			

			//thanks
			Route::get('/thanks', ['as' => 'belif.thanks', 'uses' => 'MainController@getThanks']);						

			//unsubscribe
			Route::get('/unsubscribe', ['as' => 'belif.unsubscribe', 'uses' => 'MainController@getUnsubscribe']);									
			
			
			
			//secure HTTPS
			Route::group(array('middleware' => 'AppHTTPS'), function() {
			
			
			/*
				//login
				Route::get('/login', ['as' => 'soup.login', 'uses' => 'SignUpController@getLogin']);
				Route::post('/login', ['as' => 'soup.login', 'uses' => 'SignUpController@postLogin']);
				Route::get('/logout', ['as' => 'soup.logout', 'uses' => 'SignUpController@getLogout']);
				//forgotten password
				Route::get('/forgot', ['as' => 'soup.forgot', 'uses' => 'SignUpController@getForgot']);
				Route::post('/forgot', ['as' => 'soup.forgot', 'uses' => 'SignUpController@postForgot']);
				Route::get('/forgot/sent', ['as' => 'soup.forgot.sent', 'uses' => 'SignUpController@getResetSent']);			
				Route::get('/password/reset/{safestr}', ['as' => 'soup.password.reset.id', 'uses' => 'SignUpController@getChangePassword']);	
				Route::post('/password/reset', ['as' => 'soup.password.reset', 'uses' => 'SignUpController@postChangePassword']);	
				Route::get('/password/reset/thanks/{safestr}', ['as' => 'soup.password.reset.thanks', 'uses' => 'SignUpController@getPasswordChanged']);	
				
				//user already logged in
				Route::group(array('middleware' => 'AppUser'), function() {
					//sign up
					Route::get('/signup', ['as' => 'soup.signup', 'uses' => 'SignUpController@getSignup']);
					Route::post('/signup', ['as' => 'soup.signup', 'uses' => 'SignUpController@postSignup']);
				});
				
				//post signup
				Route::group(array('middleware' => ['AppSignUp']), function() {
					Route::get('/signup/info', ['as' => 'soup.signup.info', 'uses' => 'SignUpController@getSignupData']);
					Route::post('/signup/info', ['as' => 'soup.signup.info', 'uses' => 'SignUpController@postSignupData']);
					Route::get('/signup/code', ['as' => 'soup.signup.code', 'uses' => 'SignUpController@getSignupCode']);
					Route::post('/signup/code', ['as' => 'soup.signup.code', 'uses' => 'SignUpController@postSignupCode']);
					
					//new signup (haven't requested member state)
					Route::group(array('middleware' => 'NewSignUp'), function() {
						Route::get('/signup/request', ['as' => 'soup.signup.request', 'uses' => 'SignUpController@getSignupRequest']);
						Route::post('/signup/request', ['as' => 'soup.signup.request', 'uses' => 'SignUpController@postSignupRequest']);
					});
					Route::get('/signup/thanks', ['as' => 'soup.signup.thanks', 'uses' => 'SignUpController@getSignupThanks']);
				});
				
				//authenticated routes
				Route::group(array('middleware' => ['AppAuth']), function() {
					
					//quiz
					Route::group(array('middleware' => 'AppQuiz'), function() {
						Route::get('/quiz', ['as' => 'soup.quiz', 'uses' => 'QuizController@getQuiz']);
						Route::get('/question', ['as' => 'soup.question', 'uses' => 'QuizController@getQuestion']);
						Route::get('/question/{id}', ['as' => 'soup.question.id', 'uses' => 'QuizController@getQuestion']);
						Route::post('/question', ['as' => 'soup.question', 'uses' => 'QuizController@postQuestion']);
					});
					Route::get('/quiz/thanks', ['as' => 'soup.quiz.thanks', 'uses' => 'QuizController@getThanks']);
					Route::get('/quiz/complete', ['as' => 'soup.quiz.complete', 'uses' => 'QuizController@getCompleteQuiz']);
		
		
					//check for waiting reviews
					Route::group(array('middleware' => 'AppReview'), function() {
		
						//guide
						Route::get('/guide/{id}', ['as' => 'soup.guide', 'uses' => 'MainController@getGuide']);
						Route::post('/guide/{id}', ['as' => 'soup.guide', 'uses' => 'MainController@postGuide']);
						Route::get('/guide/tipping', ['as' => 'soup.guide.tipping', 'uses' => 'MainController@getTipping']);
						Route::get('/guide/transparency', ['as' => 'soup.guide.transparency', 'uses' => 'MainController@getTransparency']);
			
						//user
						Route::get('/user/profile', ['as' => 'soup.user.profile', 'uses' => 'MainController@getUserProfile']);
					
						//venue
						Route::get('/venue/recommendations', ['as' => 'soup.venue.recommendation', 'uses' => 'MainController@getVenueRecommendations']);
						Route::get('/venue/profile/{id}', ['as' => 'soup.venue.profile', 'uses' => 'MainController@getVenueProfile']);
						
						//reservation
						Route::get('/reservation/{id}', ['as' => 'soup.reservation.id', 'uses' => 'MainController@getReservation']);
						Route::get('/reservation/{id}/{safestr2}', ['as' => 'soup.reservation.id.id', 'uses' => 'MainController@getReservation']);
						Route::post('/reservation', ['as' => 'soup.reservation', 'uses' => 'MainController@postReservation']);
						Route::get('/reservation-confirm/{safestr}', ['as' => 'soup.reservation.confirm.id', 'uses' => 'MainController@getReservationConfirmation']);
						Route::post('/reservation-confirm', ['as' => 'soup.reservation.confirm', 'uses' => 'MainController@postReservationConfirmation']);
						Route::get('/reservation-thanks/{safestr}', ['as' => 'soup.reservation.thanks', 'uses' => 'MainController@getReservationThanks']);
					
					}); //end middleware (auto navigate to active reviews)
						
						
					//review
					Route::get('/reservation/review/{safestr}', ['as' => 'soup.reservation.review.id', 'uses' => 'MainController@getReview']);
					Route::post('/reservation/review', ['as' => 'soup.reservation.review', 'uses' => 'MainController@postReview']);
				
				}); //end middleware (authorised users only)
			
			*/
			
			}); //end middleware (HTTPS only)
		
		
		//}); //end middleware (mobile only)
	
	
	}); //end namespace group
	

?>
