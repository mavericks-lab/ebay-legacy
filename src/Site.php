<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 18/03/2015
 * Time: 22:42
 */

namespace Maverickslab\Ebay;


class Site
{
    use InjectAPIRequester;

    public function get($user_token)
    {
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken' => $user_token
        ];
        $inputs['DetailName'] = [
            'SiteDetails',
            'ShippingLocationDetails'
        ];

        return $this->requester->request($inputs, 'GeteBayDetails');
    }

}