<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 18/03/2015
 * Time: 18:31
 */

namespace Maverickslab\Ebay;


trait InjectAPIRequester {
    public $requester;

    public function __construct(APIRequester $requester){
        $this->requester = $requester;
    }
}