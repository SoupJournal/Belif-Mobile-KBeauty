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
	Route::group(array('namespace' => 'Soup\Mobile\Controllers', 'middleware' => ['web'/*, 'HTTPS'*/]), function() {
	
	
		Route::get('/', ['as' => 'soup.welcome', /*'middleware' => 'CMSAuth',*/ 'uses' => 'SiteController@getIndex']);
		
		//login
		Route::get('/login', ['as' => 'soup.login', 'uses' => 'SiteController@getLogin']);
		Route::post('/login', ['as' => 'soup.login', 'uses' => 'SiteController@postLogin']);
		Route::get('/logout', ['as' => 'soup.logout', 'uses' => 'SiteController@getLogout']);
		//forgotten password
		Route::get('/forgot', ['as' => 'soup.forgot', 'uses' => 'SiteController@getForgot']);
		Route::post('/forgot', ['as' => 'soup.forgot', 'uses' => 'SiteController@postForgot']);
		Route::get('/forgot/sent', ['as' => 'soup.forgot.sent', 'uses' => 'SiteController@getResetSent']);			
		Route::get('/password/reset/{safestr}', ['as' => 'soup.password.reset.id', 'uses' => 'SiteController@getChangePassword']);	
		Route::post('/password/reset', ['as' => 'soup.password.reset', 'uses' => 'SiteController@postChangePassword']);	
		Route::get('/password/reset/thanks/{safestr}', ['as' => 'soup.password.reset.thanks', 'uses' => 'SiteController@getPasswordChanged']);	
		
		//user already logged in
		Route::group(array('middleware' => 'AppUser'), function() {
			//sign up
			Route::get('/signup', ['as' => 'soup.signup', 'uses' => 'SiteController@getSignup']);
			Route::post('/signup', ['as' => 'soup.signup', 'uses' => 'SiteController@postSignup']);
		});
		
		//post signup
		Route::group(array('middleware' => 'AppSignUp'), function() {
			Route::get('/signup/info', ['as' => 'soup.signup.info', 'uses' => 'SiteController@getSignupData']);
			Route::post('/signup/info', ['as' => 'soup.signup.info', 'uses' => 'SiteController@postSignupData']);
			Route::get('/signup/code', ['as' => 'soup.signup.code', 'uses' => 'SiteController@getSignupCode']);
			Route::post('/signup/code', ['as' => 'soup.signup.code', 'uses' => 'SiteController@postSignupCode']);
			
			//new signup (haven't requested member state)
			Route::group(array('middleware' => 'NewSignUp'), function() {
				Route::get('/signup/request', ['as' => 'soup.signup.request', 'uses' => 'SiteController@getSignupRequest']);
				Route::post('/signup/request', ['as' => 'soup.signup.request', 'uses' => 'SiteController@postSignupRequest']);
			});
			Route::get('/signup/thanks', ['as' => 'soup.signup.thanks', 'uses' => 'SiteController@getSignupThanks']);
		});
		
		//authenticated routes
		Route::group(array('middleware' => 'AppAuth'), function() {
			
			//quiz
			//Route::group(array('middleware' => 'AppQuiz'), function() {
				Route::get('/quiz', ['as' => 'soup.quiz', 'uses' => 'QuizController@getQuiz']);
				Route::get('/question', ['as' => 'soup.question', 'uses' => 'QuizController@getQuestion']);
				Route::get('/question/{id}', ['as' => 'soup.question.id', 'uses' => 'QuizController@getQuestion']);
				Route::post('/question', ['as' => 'soup.question', 'uses' => 'QuizController@postQuestion']);
				Route::get('/quiz/thanks', ['as' => 'soup.quiz.thanks', 'uses' => 'QuizController@getThanks']);
				Route::get('/quiz/complete', ['as' => 'soup.quiz.complete', 'uses' => 'QuizController@getCompleteQuiz']);
			//});

			//user
			Route::get('/user/profile', ['as' => 'soup.user.profile', 'uses' => 'MainController@getUserProfile']);
		
			//venue
			Route::get('/venue/recommendations', ['as' => 'soup.venue.recommendation', 'uses' => 'MainController@getVenueRecommendations']);
			Route::get('/venue/profile/{id}', ['as' => 'soup.venue.profile', 'uses' => 'MainController@getVenueProfile']);
			
			//reservation
			Route::get('/reservation/{id}', ['as' => 'soup.reservation.id', 'uses' => 'MainController@getReservation']);
			Route::get('/reservation/{id}/{safestr}', ['as' => 'soup.reservation.id.id', 'uses' => 'MainController@getReservation']);
			Route::post('/reservation', ['as' => 'soup.reservation', 'uses' => 'MainController@postReservation']);
			Route::get('/reservation/confirm/{safestr}', ['as' => 'soup.reservation.confirm.id', 'uses' => 'MainController@getReservationConfirmation']);
			Route::post('/reservation/confirm', ['as' => 'soup.reservation.confirm', 'uses' => 'MainController@postReservationConfirmation']);
			Route::get('/reservation/thanks/{safestr}', ['as' => 'soup.reservation.thanks', 'uses' => 'MainController@getReservationThanks']);
		
		
		});
	
	
	}); //end namespace group
	

?>
