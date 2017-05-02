<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 17/03/2015
 * Time: 23:58
 */

namespace Maverickslab\Ebay\Facade;


use Illuminate\Support\Facades\Facade;

class Ebay extends Facade{
    protected static function getFacadeAccessor() {
        return 'Ebay';
    }
}