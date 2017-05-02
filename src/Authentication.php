<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 18/03/2015
 * Time: 11:28
 */

namespace Maverickslab\Ebay;


use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Authentication
{
    use InjectAPIRequester;

    public function install()
    {
        return self::getSessionId();
    }

    /**
     * Make the initial request to eBay for a request session
     * Redirects  user to eBay to authorize the app
     *
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    public function getSessionId($site_id = 0, $return_session_id = true)
    {
        $inputs = [];
        $inputs['RuName'] = config('ebay.runame');

        $response = $this->requester->request($inputs, 'GetSessionID', $site_id);

        if (!$return_session_id) {
            if ($response['Ack'] === 'Success') {
                $session_id = $response['SessionID'];
                Session::put('ebay_session_id', $session_id);

                $base_url = config('ebay.sign_in_url') . config('ebay.sign_in_urls')[$site_id];

                $url = $base_url
                    . "?SignIn&runame="
                    . config("ebay.runame")
                    . "&SessID="
                    . urlencode($session_id);

                return Redirect::to($url);
            }
        }

        return $response;
    }

    /**
     * uses the session id to make a request to eBay for the users token,
     * makes a request with the token to get user data and preferences
     *
     * @param $session_id
     *
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    public function fetchToken($session_id)
    {
        $inputs = [];
        $inputs['SessionID'] = $session_id;

        $response = $this->requester->request($inputs, 'FetchToken');

        return $response;
    }

    /**
     * @param $user_token
     *
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    public function getUserByToken($user_token)
    {
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken' => $user_token
        ];
        $inputs['DetailLevel'] = [
            'ReturnAll'
        ];

        return $response = $this->requester->request($inputs, 'GetUser');
    }

    /**
     * @param $user_token
     *
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    public function getUserPreferences($user_token)
    {
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken' => $user_token
        ];
        $inputs['ShowSellerPaymentPreferences'] = [true];
        $inputs['ShowSellerReturnPreferences'] = [true];
        $inputs['ShowSellerProfilePreferences'] = [true];
        $inputs['ShowOutOfStockControlPreference'] = [true];

        return $this->requester->request($inputs, 'GetUserPreferences');
    }

    public function getStore($user_token)
    {

        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken' => $user_token
        ];
        $inputs['LevelLimit'] = [
            1
        ];

        return $this->requester->request($inputs, 'GetStore');
    }

    public function revokeToken($user_token)
    {
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken' => $user_token
        ];
        $inputs['UnsubscribeNotification'] = [
            true
        ];

        return $this->requester->request($inputs, 'RevokeToken');
    }

    //rewrite
//    public function refreshToken($user_token)
//    {
//        $inputs = [];
//        $inputs['RequesterCredentials'] = [
//            'eBayAuthToken' => $user_token
//        ];
//        $inputs['UnsubscribeNotification'] = [
//            true
//        ];
//
//        return $this->requester->request($inputs, 'RevokeToken');
//    }

    public function getSellerProfiles($user_token)
    {
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken' => $user_token
        ];
        $inputs['includeDetails'] = [
            true
        ];

        return $this->requester->request($inputs, 'getSellerProfiles');
    }

    public function getApiAccessRules($user_token)
    {
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken' => $user_token
        ];

        return $this->requester->request($inputs, 'GetApiAccessRules');
    }
}