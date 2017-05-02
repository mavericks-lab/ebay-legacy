<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 17/03/2015
 * Time: 23:57
 */

namespace Maverickslab\Ebay;

use Exception;

class Ebay
{
    use InjectAPIRequester;

    public function __call($method_name, $args)
    {
        $class = self::normalize($method_name);

        return self::resolve($class);
    }

    public function resolve($class_name)
    {
        if (class_exists($class_name))
            return new $class_name($this->requester);

        throw new Exception("{$class_name} not found");
    }

    public function normalize($arg)
    {
        return __NAMESPACE__ . '\\' . ucfirst($arg);
    }
}