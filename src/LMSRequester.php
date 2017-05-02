<?php
    /**
     * Created by PhpStorm.
     * User: Optimistic
     * Date: 2/13/2016
     * Time: 2:18 PM
     */

    namespace Maverickslab\Ebay;


    use GuzzleHttp\Client;

    class LMSRequester
    {
        protected $http_client;

        public function __construct(Client $http_client)
        {
            $this->http_client = $http_client;
        }

        public function request($inputs, $request_type, $site_id = 0)
        {
            $headers = [
                'CONTENT-TYPE'              => 'text/xml',
                'X-EBAY-SOA-OPERATION-NAME' => $request_type,
                'X-EBAY-SOA-SERVICE-NAME'   => "BulkDataExchangeService",
                'X-EBAY-SOA-SECURITY-TOKEN' => "user token",
            ];

            $root_node = "{$request_type}Request";

            $request_body = [];
            $request_body['@attributes'] = [
                "xmlns" => "http://www.ebay.com/marketplace/services"
            ];

            $request_body['downloadJobType'] = $request_type;

            $xml = ArrayToXML::createXML($root_node, array_merge($request_body, $inputs));
            $request_body = $xml->saveXML();

            $response = $this->http_client->post(config('ebay.base_url'), [
                'headers' => $headers,
                'body'    => $request_body,
                'verify'  => false
            ]);

            return json_decode(json_encode($response->xml()), true);
        }
    }