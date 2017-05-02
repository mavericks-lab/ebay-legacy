<?php
    namespace Maverickslab\Ebay;
    /**
     * Created by PhpStorm.
     * User: Optimistic
     * Date: 21/03/2015
     * Time: 06:35
     */

    /**
     * Remove null values from an array
     *
     * @param $array
     *
     * @return array
     */
    function removeNullValues($array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value))
                removeNullValues($array);

            if (is_null($value))
                unset($array[ $key ]);
        }

        return $array;
    }