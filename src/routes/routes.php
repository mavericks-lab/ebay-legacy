<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 17/03/2015
 * Time: 11:00
 */

Route::group(['prefix' => 'ebay'], function () {
    Route::get('fetch-user-token', '\Maverickslab\Ebay\EbayController@FetchUserToken');
    Route::get('install/{site_id?}', '\Maverickslab\Ebay\EbayController@install');
    Route::get('authorized', '\Maverickslab\Ebay\EbayController@authorized');
});