<?php

	namespace Soup\Mobile\Jobs;
	
	use Soup\Mobile\Jobs\BaseJob;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Queue\InteractsWithQueue;
	use Illuminate\Contracts\Bus\SelfHandling;
	use Illuminate\Contracts\Queue\ShouldQueue;
	
	use Illuminate\Contracts\Mail\Mailer;
	
	
	class SendEmailJob extends BaseJob implements SelfHandling, ShouldQueue {
	
	
	    use InteractsWithQueue, SerializesModels;
	    
	    
	    //email properties
	    protected $recipient;
	    protected $sender;
	    protected $emailView;
	   	protected $viewProperties;
	    
	    
	    /**
	     * Create a new job instance.
	     *
	     * @return void
	     */
	    public function __construct($recipient, $sender, $emailView, $viewProperties = null) {
	    
	    	//set properties
	        $this->recipient = $recipient;
	        $this->sender = $sender;
	        $this->emailView = $emailView;
	        $this->viewProperties = $viewProperties;
	        
	    } //end constructor()
	    
	    
	    /**
	     * Execute the job.
	     *
	     * @return void
	     */
	    public function handle() //Mailer $mailer)
	    {
	    	//$this->info('Display this on the screen');
//	    	$output = new \Symfony\Component\Console\Output\ConsoleOutput(2);
//
//$output->writeln('hello');
	    	
	    	//var_dump("got queue event");
	    	//dd($this);
	    	
	    	/*
	    	//send through Laravel
			try {
				$viewParams = [
					'text' => "recipient: " . $this->recipient . " - sender: " . $this->sender . " - emailView: " . $this->emailView
				];
				
				
				//send email
				$result = \Mail::send('soup::email.request', $viewParams, function ($data) {
				//$result = $mailer->send('soup::email.request', $viewParams, function ($data) {
					//$data->from(AppGlobals::EMAIL_SENDER_MEMBER_REQUEST, 'Soup');
					$data->from("test@belifinhydration.com", 'Soup');
					$data->to("aberrationmedia@gmail.com", "some name");
					$data->subject("some subject");
				});
				
//				//send email
//				$result = \Mail::send('soup::email.request', $viewParams, function ($data) {
//					$data->from(AppGlobals::EMAIL_SENDER_MEMBER_REQUEST, 'Soup');
//					$data->from("test@belifinhydration.com", 'Soup');
//					$data->to("aberrationmedia@gmail.com", "some name");
//					$data->subject("some subject");
//				});
			//echo "sent email";
				
			}
			//Laravel SMTP failed try alternate
			catch (Exception $e) {
		*/
		echo "recipient: " . $this->recipient . "\n";
		echo "sender: " . $this->sender . "\n";
		echo "emailView: " . $this->emailView . "\n";
		echo "viewProperties: " . print_r($this->viewProperties, true) . "\n";
		echo "test\n";
				//create headers
				$headers = "MIME-Version: 1.0\r\n"
						 . "Content-type: text/html;charset=UTF-8\r\n"
						 . "From: " . "test@soupjournal.com" . "\r\n";
						 
		var_dump($headers);				 
		dd($headers);
		//		$body = "recipient: " . $this->recipient . " - sender: " . $this->sender . " - emailView: " . $this->emailView;
//				$body = $view->render();
$body = "my test";
		
				//send email through sendmail
				$result = mail("aberrationmedia@gmail.com", "some subject1111", $body, $headers);	
								
		/*	}
	    */	
	    	
//	        $mailer->send('email.welcome', ['data'=>'data'], function ($message) {
//	            $message->from('nwambachristian@gmail.com', 'Christian Nwmaba');
//	            $message->to('nwambachristian@gmail.com');
//	        });

	    } //end handle()
	    
	    
	    
	    
	    
//	    public function failed(Exception $exception) {
//
//			//parent::failed($exception);
//			echo "got queue fail event\n";
//var_dump( $exception );
////$this->info('Display this on the screen');
//		    // handle failure
////		    dd($exception);
//		    
//		} //end failed()
	    
	    
	} //end class SendEmailJob
	

?>