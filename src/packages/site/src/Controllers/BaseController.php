<?php

namespace Belif\Mobile\Controllers;

use Belif\Mobile\Models\Page;
use Belif\Mobile\Models\Product;
use Soup\CMS\Models\CMSApp;

use Session;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    //page constants
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
    const FORM_PRODUCTS = 'page_products';
    const FORM_ADDRESS = 'page_address';
    const FORM_VERIFY = 'page_verify';
    const FORM_CONFIRM = 'page_confirm';
    const FORM_SHARE = 'page_share';
    const FORM_THANKS = 'page_thanks';
    const FORM_NO_SAMPLES = 'page_unavailable';
    const FORM_UNSUBSCRIBE = 'page_unsubscribe';
    const FORM_DESKTOP = 'page_desktop';

    //emails
    const EMAIL_VERIFY = 'email_verify';
    const EMAIL_PRODUCT = 'email_product';
    const EMAIL_SHARE = 'email_share';

    //product email images
    //const EMAIL_PRODUCT_IMAGES = 'email_images';

    //verify email details
    const EMAIL_SENDER_VERIFY = 'team@sulwhasoo5scents.com';
    const EMAIL_SUBJECT_VERIFY = 'Verify your email to claim your gift.';

    //share email details
    const EMAIL_SENDER_SHARE = 'team@sulwhasoo5scents.com';
    const EMAIL_SUBJECT_SHARE = ' wants to give you the gift of Sulwhasoo.';

    //product email details
    const EMAIL_SENDER_PRODUCT = 'team@sulwhasoo5scents.com';
    const EMAIL_SUBJECT_PRODUCT = "Your sample is on its way!";

    //number of questions
    private $numberOfQuestions = 7;

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

} //end class BaseController

?>