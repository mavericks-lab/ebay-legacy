<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 19/03/2015
 * Time: 15:33
 */

namespace Maverickslab\Ebay;


class ReturnPolicy {
    use InjectAPIRequester;

    public function get($user_token){
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken'=>$user_token
        ];
//        $inputs['DetailName'] = [
//            'ReturnPolicyDetails'
//        ];

        return $this->requester->request($inputs, 'GeteBayDetails');
    }
}