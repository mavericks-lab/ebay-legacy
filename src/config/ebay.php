<?php
    /**
     * Created by PhpStorm.
     * User: Optimistic
     * Date: 17/03/2015
     * Time: 11:01
     */

    return [
        'api_compatibility_level' => env('EBAY_COMPATIBILITY_LEVEL'),
        'runame'                  => env('EBAY_RUNAME'),
        'api_dev_name'            => env('EBAY_API_DEV_NAME'),
        'api_app_name'            => env('EBAY_API_APP_NAME'),
        'api_cert_name'           => env('EBAY_API_CERT_NAME'),
        'sign_in_url'             => env('EBAY_SIGN_IN_URL'),
        'base_url'                => env('EBAY_BASE_URL'),
        'lms_bdexs_url'           => env('EBAY_LMS_BDExS_URL'),
        'lms_fts_url'             => env('EBAY_LMS_FTS_URL'),
        'warning_level'           => env('EBAY_WARNING_LEVEL'),
        'error_language'          => env('EBAY_ERROR_LANGUAGE'),
        'entries_per_page'        => env('EBAY_ENTRIES_PER_PAGE', 50),
        'orders_within_days'      => env('EBAY_ORDERS_WITHIN_DAYS', 30),
        'cloudinary_cloud_name'   => env('CLOUDINARY_CLOUD_NAME'),
        'cloudinary_api_key'      => env('CLOUDINARY_API_KEY'),
        'cloudinary_api_secret'   => env('CLOUDINARY_API_SECRET'),
        'sign_in_urls'            => [
            0   => ".com/ws/eBayISAPI.dll",
            2   => ".ca/ws/eBayISAPI.dll",
            3   => ".co.uk/ws/eBayISAPI.dll",
            15  => ".com.au/ws/eBayISAPI.dll",
            16  => ".at/ws/eBayISAPI.dll",
            23  => ".com/ws/eBayISAPI.dll", //".be/ws/eBayISAPI.dll",
            71  => ".fr/ws/eBayISAPI.dll",
            77  => ".de/ws/eBayISAPI.dll",
            100 => ".com/ws/eBayISAPI.dll", //null,
            101 => ".it/ws/eBayISAPI.dll",
            123 => ".com/ws/eBayISAPI.dll", //".be/ws/eBayISAPI.dll",
            146 => ".nl/ws/eBayISAPI.dll",
            186 => ".es/ws/eBayISAPI.dll",
            193 => ".ch/ws/eBayISAPI.dll",
            201 => ".com/ws/eBayISAPI.dll", //".com.hk/ws/eBayISAPI.dll",
            203 => ".in/ws/eBayISAPI.dll",
            205 => ".ie/ws/eBayISAPI.dll",
            207 => ".com/ws/eBayISAPI.dll", //".com.my/ws/eBayISAPI.dll",
            210 => ".com/ws/eBayISAPI.dll", //null,
            211 => ".com/ws/eBayISAPI.dll", //".ph/ws/eBayISAPI.dll",
            212 => ".pl/ws/eBayISAPI.dll",
            216 => ".com/ws/eBayISAPI.dll", //".com.sg/ws/eBayISAPI.dll"
        ],
        'notifications'           => [
            'FixedPriceTransaction',
            'ItemClosed',
            'ItemExtended',
            'ItemListed',
            'ItemRevised',
            'ItemSuspended',
            'TokenRevocation',
            'UserIDChanged'
        ],
        'notificationUrl'         => env('EBAY_NOTIFICATION_URL'),
        'user_token'              => env('EBAY_USER_TOKEN')
    ];



