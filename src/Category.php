<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 18/03/2015
 * Time: 22:51
 */

namespace Maverickslab\Ebay;


class Category {
    use InjectAPIRequester;

    public function get($user_token, $level_limit=1, $site_id=0){
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken'=>$user_token
        ];
        $inputs['CategorySiteID'] = [
            $site_id
        ];
        $inputs['LevelLimit'] = [
            $level_limit
        ];
        $inputs['DetailLevel'] = [
            'ReturnAll'
        ];

        return $this->requester->request($inputs, 'GetCategories', $site_id);
    }

    public function getFeatures($user_token, $category_id, $site_id=0){
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken'=>$user_token
        ];
        $inputs['CategoryID'] = [
            $category_id
        ];
        $inputs['DetailLevel'] = [
            'ReturnAll'
        ];

        return $this->requester->request($inputs, 'GetCategoryFeatures', $site_id);
    }

    public function getSpecifics($user_token, $category_id, $site_id=0){
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken'=>$user_token
        ];
        $inputs['CategoryID'] = [
            $category_id
        ];
        $inputs['DetailLevel'] = [
            'ReturnAll'
        ];

        return $this->requester->request($inputs, 'GetCategorySpecifics', $site_id);
    }
}