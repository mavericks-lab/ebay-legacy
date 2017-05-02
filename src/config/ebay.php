<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 17/03/2015
 * Time: 11:01
 */

return [
    'content_type'            => 'text/xml',
    'api_compatibility_level' => 911,
    'runame'                  => 'replace this with a valid runame',
    'api_dev_name'            => 'replace this with a valid dev name - DevID',
    'api_app_name'            => 'replace this with a valid app name - AppID',
    'api_cert_name'           => 'replace this with a valid cert name - CertID',
    'sign_in_url'             => 'https://signin.sandbox.ebay.com/ws/eBayISAPI.dll', #replace this
    'base_url'                => 'https://api.sandbox.ebay.com/ws/api.dll', #replace this
    'lms_bdexs_url'           => 'https://webservices.sandbox.ebay.com/BulkDataExchangeService', #replace this
    'lms_fts_url'             => 'https://storage.sandbox.ebay.com/FileTransferService', #replace this
    'warning_level'           => 'High',
    'error_language'          => 'en_US',
    'entries_per_page'        => 50,
    'orders_within_days'      => 30,
    'notifications'           => [ #modify if there are any changes
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
];


