<?php
    /**
     * Created by PhpStorm.
     * User: Optimistic
     * Date: 18/03/2015
     * Time: 22:55
     */

    namespace Maverickslab\Ebay;


    class ShippingService
    {
        use InjectAPIRequester;

        public function get($user_token, $site_id = 0)
        {
            $inputs = [];
            $inputs['RequesterCredentials'] = [
                'eBayAuthToken' => $user_token
            ];
            $inputs['DetailName'] = [
                'ShippingServiceDetails'
            ];

            return $this->requester->request($inputs, 'GeteBayDetails', $site_id);
        }
    }