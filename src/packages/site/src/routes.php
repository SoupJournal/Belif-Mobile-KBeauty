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
	Route::group(array('namespace' => 'Belif\Mobile\Controllers', 'middleware' => ['web', 'HTTPS']), function() {
	
		//desktop only access
		Route::group(array('middleware' => 'AppDesktop'), function() {
	
			//desktop
			Route::get('/desktop', ['as' => 'belif.desktop', 'uses' => 'MainController@getDesktop']);
		
		});
	
		//mobile only access
		Route::group(array('middleware' => 'AppMobile'), function() {
	
			//secure HTTPS
			Route::group(array('middleware' => 'AppHTTPS'), function() {
			
				//product is available
				Route::group(array('middleware' => 'ProductAvailable'), function() {

					//email
					Route::get('/', ['as' => 'belif.home', 'uses' => 'MainController@getEmail']);
					//Route::get('/email', ['as' => 'belif.email', 'uses' => 'MainController@getEmail']);
					Route::post('/email', ['as' => 'belif.email', 'uses' => 'MainController@postEmail']);
					
					//email required
					Route::group(array('middleware' => 'EmailRequired'), function() {
					
						//question
						Route::get('/question', ['as' => 'belif.question', 'uses' => 'ProductController@getQuestion']);		
						Route::get('/previousquestion', ['as' => 'belif.question.previous', 'uses' => 'ProductController@getPreviousQuestion']);		
						Route::get('/answer', ['as' => 'belif.answer', 'uses' => 'ProductController@getAnswer']);	
						Route::post('/answer/{id}', ['as' => 'belif.answer.id', 'uses' => 'ProductController@postAnswer']);	
						
						//results
						Route::get('/results', ['as' => 'belif.results', 'uses' => 'ProductController@getResults']);
						
						//ensure product samples have been selected
						Route::group(array('middleware' => 'ProductRequired'), function() {
						
							//address
							Route::get('/address', ['as' => 'belif.address', 'uses' => 'MainController@getAddress']);
							Route::post('/address', ['as' => 'belif.address', 'uses' => 'MainController@postAddress']);
							
						});
						
						//verfication
						Route::get('/verify', ['as' => 'belif.verify', 'uses' => 'MainController@getVerify']);

						// remove the get method eventually
						Route::get('/sharefriend', ['as' => 'belif.sharefriend', 'uses' => 'MainController@postSharefriend']);
						Route::post('/sharefriend', ['as' => 'belif.sharefriend', 'uses' => 'MainController@postSharefriend']);
					
					}); //end middleware (Email required)
					
				}); //end middleware (Product is available)
				
				//unavailable
				Route::get('/unavailable', ['as' => 'belif.unavailable', 'uses' => 'MainController@getUnavailable']);
				
				//share
				Route::get('/share', ['as' => 'belif.share', 'uses' => 'MainController@getShare']);			
				Route::post('/share', ['as' => 'belif.share', 'uses' => 'MainController@postShare']);			
	
				//thanks
				Route::get('/thanks', ['as' => 'belif.thanks', 'uses' => 'MainController@getThanks']);						
	
				//unsubscribe
				Route::get('/unsubscribe', ['as' => 'belif.unsubscribe', 'uses' => 'MainController@getUnsubscribe']);	
					
				
			}); //end middleware (HTTPS only)
		
			//TEST EMAIL
			//Route::get('/testemail', ['as' => 'belif.email.test', 'uses' => 'MainController@getEmailTest']);						
		
		}); //end middleware (mobile only)
	
	
	}); //end namespace group
	

?>
