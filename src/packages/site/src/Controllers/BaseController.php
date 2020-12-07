<?php

namespace Belif\Mobile\Controllers;

use Belif\Mobile\Jobs\SendEmailJob;
use Belif\Mobile\Models\Page;
use Belif\Mobile\Models\Product;
use Belif\Mobile\Models\ProductImage;
use Soup\CMS\Models\CMSApp;

use Session;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    //page constants
    const FORM_LANDING = 'page_landing';
    const FORM_EMAIL = 'page_email';
    const FORM_GUIDE = 'page_guide';
    const FORM_QUESTION = 'page_question';
    const FORM_ANSWER = 'page_answer';
    const FORM_RESULTS = 'page_results';
    const FORM_RESULTS_A = 'page_results_a';
    const FORM_RESULTS_B = 'page_results_b';
    const FORM_RESULTS_C = 'page_results_c';
    const FORM_RESULTS_D = 'page_results_d';
    const FORM_RESULTS_E = 'page_results_e';
    const FORM_RESULTS_F = 'page_results_f';
    const FORM_RESULTS_G = 'page_results_g';
    const FORM_RESULTS_H = 'page_results_h';
    const FORM_PRODUCTS = 'page_products';
    const FORM_ADDRESS = 'page_address';
    const FORM_VERIFY = 'page_verify';
    const FORM_CONFIRM = 'page_confirm';
    const FORM_SHARE = 'page_share';
    const FORM_THANKS = 'page_thanks';
    const FORM_NO_SAMPLES = 'page_unavailable';
    const FORM_UNSUBSCRIBE = 'page_unsubscribe';
    const FORM_DESKTOP = 'page_desktop';

    // emails
    const EMAIL_VERIFY = 'email_verify';
    const EMAIL_PRODUCT = 'email_product';
    const EMAIL_SHARE = 'email_share';

    // verify email details
    const EMAIL_SENDER_VERIFY = 'team@belif-let-it-glow.com ';
    const EMAIL_SUBJECT_VERIFY = 'Verify your email and to claim your belif products';

    // share email details
    const EMAIL_SENDER_SHARE = 'team@belif-let-it-glow.com ';
    const EMAIL_SUBJECT_SHARE = ' your friend wants to share some holiday cheer with you';

    // product email details
    const EMAIL_SENDER_PRODUCT = 'team@belif-let-it-glow.com ';
    const EMAIL_SUBJECT_PRODUCT = "Your belif samples are on their way! ";

    const EMAIL_SUBJECT_PRIZE = 'Your belif prize';
    const EMAIL_SUBJECT_MESSAGE = 'Some holiday cheer from us to you';

    //number of questions
    private $numberOfQuestions = 3;

    public function __construct()
    {
        $application = CMSApp::get()->first();

        $this->header_logo_url_black = $application->header_logo_url_black;
        $this->header_logo_url_white = $application->header_logo_url_white;
        $this->terms_and_conditions_url = $application->terms_and_conditions_url;

    } //end constructor()

    //catch all undefined request and route to home
    public function missingMethod($parameters = array())
    {
        return Redirect::route('belif.home');

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

    protected function productAvailable()
    {

        //get available products
        $products = Product::where('available', true)->get();

        //indicate if products available
        return count($products)>0;

    } //end productAvailable()

    protected function getSelectedProducts()
    {

        //get selected products
        return Session::get('selectedProducts');

    } //end getSelectedProducts()

    protected function dataForPage($pageKey)
    {

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

    } //end dataForPage()

    //==========================================================//
    //====					EMAIL METHODS					====//
    //==========================================================//

    public function sendVerifyEmail($user) {

        $result = false;

        //valid user
        if ($user && $user->email && strlen($user->email)>0) {

            //generate and store unique code
            $this->generateVerifyCode($user);

            //valid code
            if ($user->verify_code && strlen($user->verify_code)>0) {

                //get page data
                $pageData = $this->dataForPage(self::EMAIL_VERIFY);

                //compile last address line
                $address3 = $user->city;
                if ($user->state && strlen($user->state)>0) {
                    $address3 .= strlen($address3)>0 ? ', ' . $user->state : $user.state;
                }
                if ($user->zip_code && strlen($user->zip_code)>0) {
                    $address3 .= strlen($address3)>0 ? ', ' . $user->zip_code : $user.zip_code;
                }

                if ($user->answers == 'message') {
                    $emailType = 'message';
                    $emailMessage = $user->all_answers;
                } else {
                    $emailType = 'prize';
                    $emailMessage = $user->all_answers;
                }

                //send confirm email (sent via queue to avoid delay loading next page)
                $emailJob = new SendEmailJob([
                    "recipient" => $user->email,
                    "sender" => [
                        'email' => self::EMAIL_SENDER_VERIFY,
                        'name' => 'belif'
                    ],
                    "subject" => self::EMAIL_SUBJECT_VERIFY,
                    "view" => "belif::email.verify",
                    "view_properties" => [
                        'name' => $user->name,
                        'address1' => $user->address_1,
                        'address2' => $user->address_2,
                        'address3' => $address3,
                        'emailType' => $emailType,
                        'emailMessage' => $emailMessage,
                        'pageData' => $pageData,
                        'verifyLink' => route('belif.share', ['code' => $user->verify_code]),
                        'unsubscribeLink' => route('belif.unsubscribe', ['code' => $user->verify_code])
                    ]
                ]);
                $this->dispatch($emailJob);
                $result = true;

            } //end if (valid code)

        } //end if (valid user)

        return $result;

    } //end sendVerifyEmail()

    public function sendShareEmail($user, $shareUser)
    {
        $result = false;

        //valid user
        if ($user && $user->email && strlen($user->email)>0) {


            //valid share address
            if ($shareUser && $shareUser->email && strlen($shareUser->email)>0) {


                //shared user has not unsubscribed
                if (!$shareUser->unsubscribed) {

                    //generate and store unique code (if one doesn't already exist)
                    $this->generateVerifyCode($shareUser);

                    //get page data
                    $pageData = $this->dataForPage(self::EMAIL_SHARE);

                    //create subject line
                    $subject = $user->name . self::EMAIL_SUBJECT_SHARE;

                    //send share email (sent via queue to avoid delay loading next page)
                    $emailJob = new SendEmailJob([
                        "recipient" => $shareUser->email,
                        "sender" => [
                            'email' => self::EMAIL_SENDER_SHARE,
                            'name' => 'belif'
                        ],
                        "subject" => $subject,
                        "view" => "belif::email.share",
                        "view_properties" => [
                            'pageData' => $pageData,
                            'unsubscribeLink' => route('belif.unsubscribe', ['code' => $shareUser->verify_code])
                        ]
                    ]);
                    $this->dispatch($emailJob);
                    $result = true;

                }

            } //end if (valid share address)

        } //end if (valid user)


        return $result;

    } //end sendShareEmail()

    public function sendProductEmail($user)
    {
        $result = false;

        //valid user
        if ($user && $user->email && strlen($user->email)>0) {

            //generate and store unique code
            $this->generateVerifyCode($user);


            //valid code
            if ($user->verify_code && strlen($user->verify_code)>0) {


                //get page data
                $pageData = $this->dataForPage(self::EMAIL_PRODUCT);


                //compile last address line
                $address3 = $user->city;
                if ($user->state && strlen($user->state)>0) {
                    $address3 .= strlen($address3)>0 ? ', ' . $user->state : $user.state;
                }
                if ($user->zip_code && strlen($user->zip_code)>0) {
                    $address3 .= strlen($address3)>0 ? ', ' . $user->zip_code : $user.zip_code;
                }

                //get image data
                $imageData = ProductImage::where(function ($query) use ($user) {
                    $query->where('product_1', $user->product_1)
                        ->where('product_2', $user->product_2);
                })
                    ->orWhere(function ($query) use ($user) {
                        $query->where('product_2', $user->product_1)
                            ->where('product_1', $user->product_2);
                    })
                    ->first();

                //get product image
                $productImage = null;
                if ($imageData) {
                    $productImage = safeObjectValue('image', $imageData, null);
                }

                //determine if multiple samples sent
                $multipleSamples = isset($user->product_1) && isset($user->product_2);

                //send product sent email (sent via queue to avoid delay loading next page)
                $emailJob = new SendEmailJob([
                    "recipient" => $user->email,
                    "sender" => [
                        'email' => self::EMAIL_SENDER_PRODUCT,
                        'name' => 'belif'
                    ],
                    "subject" => self::EMAIL_SUBJECT_PRODUCT,
                    "view" => "belif::email.product",
                    "view_properties" => [
                        'pageData' => $pageData,
                        'productImage' => $productImage,
                        'productColour' => '#125a7d',
                        'multipleSamples' => $multipleSamples,
                        'unsubscribeLink' => route('belif.unsubscribe', ['code' => $user->verify_code])
                    ]
                ]);
                $this->dispatch($emailJob);
                $result = true;

            } //end if (valid code)

        } //end if (valid user)


        return $result;

    } //end sendProductEmail()

    public function generateVerifyCode($user) {

        //valid user
        if ($user) {

            //generate unique code
            if (!$user->verify_code || strlen($user->verify_code)==0) {

                //create unique string
                $userString = $user->email . microtime() . uniqid();

                //encrypt code
                $user->verify_code = hash('sha256', $userString);

                //save code
                $user->save();

            }


        } //end if (valid user)

    } //end generateVerifyCode()

} //end class BaseController

?>