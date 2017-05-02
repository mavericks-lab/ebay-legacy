<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 13/04/2015
 * Time: 08:05
 */

namespace Maverickslab\Ebay;


class User {
    use InjectAPIRequester;

    public function get($user_token, $user_id){
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken'=>$user_token
        ];
        $inputs['UserID'] = [
            $user_id
        ];

        return $this->requester->request($inputs, 'GetUser');
    }
}