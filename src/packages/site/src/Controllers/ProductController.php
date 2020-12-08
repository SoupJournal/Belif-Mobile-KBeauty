<?php

namespace Belif\Mobile\Controllers;

use Belif\Mobile\Models\Question;
use Belif\Mobile\Models\Product;

use Belif\Mobile\Models\User;
use DB;
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

    public function getResults()
    {
        // get page data
        $pageData = $this->dataForPage(self::FORM_RESULTS);

        $backgroundImagePrize = safeArrayValue('background_image', $pageData);
        $backgroundImageMessage = safeArrayValue('image', $pageData);

        $products = DB::table('product')
            ->where([
                ['qty_available', '>', 0],
                ['available', true],
            ])
            ->get();

        $questions = Question::all();

        // store email
        $email = Session::get('email');

        // find existing user
        $user = User::where('email', $email)->first();

        $firstname = explode(' ', $user->name)[0];

        $resultType = 'message';
        if( ($user->id % 5) == 0) {
            $resultType = 'prize';
        }

        $phrases = [];
        $prizes = [];

        if ($resultType == 'message') {
            // get random message
            foreach ($questions as $question) {
                $phrases[] = $question->text;
            }

            shuffle($phrases);
            $result = $phrases[array_rand($phrases, 1)];
            $user->all_answers = $result;

            $this->sendVerifyEmail($user);

        } else {

            // get random prize
            foreach ($products as $product) {
                for ($i = 0; $i < $product->qty_available; $i++) {
                    $prizes[] = $product->id;
                }
            }

            shuffle($prizes);
            $productId = array_rand($prizes, 1);

            $winner = Product::find($prizes[$productId]);
            $result = $winner->name;
            $user->all_answers = $winner->id;
            $resultImage = $winner->sample_image;
        }

        // save result for later
        $user->answers = $resultType; // message || prize
        $user->save();

        $backgroundImage = ($resultType == 'message')? $backgroundImageMessage : $backgroundImagePrize;

        return View::make('belif::pages.results')->with(Array (
            'pageName' => 'results',
            'pageData' => $pageData,
            'user' => $user,
            'firstname' => $firstname,
            'result' => $result,
            'resultType' => $resultType,
            'resultImage' => $resultImage,
            'headerLogoUrl' => $this->header_logo_url_white,
            'backgroundImage' => $backgroundImage,
            'formURL' => route('belif.share.submit'),
            'termsURL' => $this->terms_and_conditions_url
        ));

    } //end getResults()

} //end class ProductController
?>