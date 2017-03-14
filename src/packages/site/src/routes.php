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
		//Route::pattern('questionId', '[0-9]+');
	


	//==========================================================//
	//====						CMS ROUTING					====//
	//==========================================================//	
	
	
	//group controllers into namespace
	Route::group(array('namespace' => 'Soup\Mobile\Controllers', 'middleware' => ['web'/*, 'HTTPS'*/]), function() {
	
	
		Route::get('/', ['as' => 'soup.welcome', /*'middleware' => 'CMSAuth',*/ 'uses' => 'SiteController@getIndex']);
		
		//login
		Route::get('/login', ['as' => 'soup.login', 'uses' => 'SiteController@getLogin']);
		Route::post('/login', ['as' => 'soup.login', 'uses' => 'SiteController@postLogin']);
		
		//sign up
		Route::get('/signup', ['as' => 'soup.signup', 'uses' => 'SiteController@getSignup']);
		Route::post('/signup', ['as' => 'soup.signup', 'uses' => 'SiteController@postSignup']);
		//post signup
		Route::group(array('middleware' => 'AppSignUp'), function() {
			Route::get('/signup/info', ['as' => 'soup.signup.info', 'uses' => 'SiteController@getSignupData']);
			Route::post('/signup/info', ['as' => 'soup.signup.info', 'uses' => 'SiteController@postSignupData']);
			Route::get('/signup/code', ['as' => 'soup.signup.code', 'uses' => 'SiteController@getSignupCode']);
			Route::post('/signup/code', ['as' => 'soup.signup.code', 'uses' => 'SiteController@postSignupCode']);
			Route::get('/signup/request', ['as' => 'soup.signup.request', 'uses' => 'SiteController@getSignupRequest']);
			Route::post('/signup/request', ['as' => 'soup.signup.request', 'uses' => 'SiteController@postSignupRequest']);
			Route::get('/signup/thanks', ['as' => 'soup.signup.thanks', 'uses' => 'SiteController@getSignupThanks']);
		});
		
		//authicated routes
		Route::group(array('middleware' => 'AppAuth'), function() {
			
			//quiz
			Route::get('/quiz', ['as' => 'soup.quiz', 'uses' => 'SiteController@getQuiz']);
			Route::get('/question', ['as' => 'soup.question', 'uses' => 'SiteController@getQuestion']);
			Route::get('/question/{id}', ['as' => 'soup.question.id', 'uses' => 'SiteController@getQuestion']);
			Route::post('/question', ['as' => 'soup.question', 'uses' => 'SiteController@postQuestion']);
		
		});
	
	
		/*
		//Applications
		Route::group(array('middleware' => ['CMSAuth', 'CMSApp']), function() use (&$basePath) {
			
			//determine path
			$path = $basePath . '/app';
			
			//page actions
			Route::get($path, array('as' => 'cms.app.index', 'uses' => 'ApplicationController@getIndex'));
			Route::get($path . '/create', array('as' => 'cms.app.create', 'uses' => 'ApplicationController@getCreate'));
			
			//service actions
			Route::get($path . '/applications', array('as' => 'cms.app.applications', 'uses' => 'ApplicationController@getApplications'));
			Route::post($path . '/applicationid', array('as' => 'cms.app.applicationid', 'uses' => 'ApplicationController@postApplicationid'));
			//Route::resource($basePath . '/app', 'ApplicationController');
		});
		
				
		//CMS Login
		Route::get($basePath . '/login', ['as' => 'cms.login', 'middleware' => ['HTTPS'], 'uses' => 'CMSController@getLogin']);
		Route::post($basePath . '/login', ['as' => 'cms.login', 'middleware' => ['HTTPS'], 'uses' => 'CMSController@postLogin']);
		Route::get($basePath . '/logout', ['as' => 'cms.logout', 'uses' => 'CMSController@getLogout']);
	
		
		//CMS Errors
		Route::get($basePath . '/error', ['as' => 'cms.error', 'uses' => 'CMSController@getError']);
		Route::get($basePath . '/error/{safestr}', ['as' => 'cms.error', 'uses' => 'CMSController@getError']);
		
		//CMS Admin
		Route::get($basePath, ['as' => 'cms.home', 'middleware' => 'CMSAuth', 'uses' => 'CMSController@getIndex']);
		Route::get($basePath . '/{appId}' , ['as' => 'cms.home', 'middleware' => ['CMSAuth', 'CMSApp'], 'uses' => 'CMSController@getIndex']);
	
		*/
	
	
	}); //end namespace group
	

?>
