<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 12/07/2016
 * Time: 00:38
 */

namespace Maverickslab\Ebay;


class Notification
{
    use InjectAPIRequester;

    public function setNotificationPreferences($user_token)
    {
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken' => $user_token
        ];
        $inputs['ApplicationDeliveryPreferences'] = [
            'AlertEnable'       => 'Enable',
            'ApplicationEnable' => 'Enable',
            'ApplicationURL'    => config('ebay.notificationUrl'),
            'DeviceType'        => 'Platform',
        ];

        $notificationEnabled['NotificationEnable'] = [];

        foreach (config('ebay.notifications') as $notification) {
            array_push($notificationEnabled['NotificationEnable'],
                [
                    'EventType'   => $notification,
                    'EventEnable' => 'Enable'
                ]
            );
        }

        $inputs['UserDeliveryPreferenceArray'] = $notificationEnabled;

        return $this->requester->request($inputs, 'SetNotificationPreferences');
    }

    public function getNotificationPreferences($user_token)
    {
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken' => $user_token
        ];
        $inputs['PreferenceLevel'] = 'Application';

        return $this->requester->request($inputs, 'GetNotificationPreferences');
    }
}