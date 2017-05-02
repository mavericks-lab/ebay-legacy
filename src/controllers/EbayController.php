<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 17/03/2015
 * Time: 11:11
 */

namespace Maverickslab\Ebay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Maverickslab\Ebay\Exceptions\SessionGenerationFailedException;

class EbayController extends Controller
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function FetchUserToken(APIRequester $requester)
    {
        $session_id = Session::get('ebay_session_id'); #refactor this for unique tokens
        return (new Authentication($requester))->fetchToken($session_id);
    }

    public function install($site_id = 0)
    {
        $session = \Maverickslab\Ebay\Facade\Ebay::authentication()->getSessionId();

        if ($session['Ack'] == 'Success') {
            $base_url = config('ebay.sign_in_url') . config('ebay.sign_in_urls')[$site_id];

            $url = $base_url
                . "?SignIn&runame="
                . config("ebay.runame")
                . "&SessID="
                . urlencode($session['SessionID']);

            return Redirect::to($url);
        }

        throw new SessionGenerationFailedException('Session generation failed');
    }

    public function authorized(){
        return $this->request->all();
    }
}