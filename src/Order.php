<?php
/**
 * Created by PhpStorm.
 * User: Optimistic
 * Date: 18/03/2015
 * Time: 21:13
 */

namespace Maverickslab\Ebay;


class Order
{
    use InjectAPIRequester;

    /**
     * import all order withing a set period
     *
     * @param     $user_token
     * @param int $site_id
     * @param int $page
     *
     * @return mixed
     */
    public function get($user_token, $site_id = 1, $page = 1, $options = null)
    {
        $unsetNumberOfDays = false;
        $entries_per_page = config('ebay.entries_per_page');

        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken' => $user_token
        ];
        $inputs['NumberOfDays'] = [config('ebay.orders_within_days')];

        if (!is_null($options)) {
            if ($options['type'] == "new" && isset($options['create_time_from']) && isset($options['create_time_to'])) {
                $inputs['CreateTimeFrom'] = [date("c", strtotime($options['create_time_from']))];
                $inputs['CreateTimeTo'] = [date("c", strtotime($options['create_time_to']))];

                $unsetNumberOfDays = true;
            }

            if ($options['type'] == "updated" && isset($options['mod_time_from']) && isset($options['mod_time_to'])) {
                $inputs['ModTimeFrom'] = [date("c", strtotime($options['mod_time_from']))];
                $inputs['ModTimeTo'] = [date("c", strtotime($options['mod_time_to']))];

                $unsetNumberOfDays = true;
            }
        }

        if ($unsetNumberOfDays) {
            unset($inputs['NumberOfDays']);
        }

        $inputs['OrderRole'] = ['Seller'];
        $inputs['DetailLevel'] = ['ReturnAll'];
        $inputs['Pagination'] = [
            'EntriesPerPage' => $entries_per_page,
            'PageNumber'     => $page
        ];

        return $this->requester->request($inputs, 'GetOrders', $site_id);
    }


    /**
     * use this to add a new order to ebay
     * @param $user_token
     * @param $order_data
     *
     * @return mixed
     */
    public function add($user_token, $order_data)
    {
        $transaction_array = self::createTransactionArray($order_data['transactions']);

        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken' => $user_token
        ];
        $inputs['Order'] = [
            'CreatingUserRole' => 'Seller',
            'SellerEmail'      => 'email_address',
            'PaymentMethods'   => 'PayPal',
            'ShippingDetails'  => [
                'CODCost'                => $order_data['COD'],
                'InsuranceFee'           => $order_data['insurance_fee'],
                'InsuranceOption'        => $order_data['insurance_option'],
                'SalesTax'               => [
                    'SalesTaxPercent'       => $order_data['sales_tax_percentage'],
                    'SalesTaxState'         => $order_data['sales_tax_state'],
                    'ShippingIncludedInTax' => $order_data['shipping_included_in_tax']
                ],
                'ShippingServiceOptions' => [
                    'ShippingInsuranceCost'         => $order_data['shipping_insurance_cost'],
                    'ShippingService'               => $order_data['shipping_service'],
                    'ShippingServiceAdditionalCost' => $order_data['shipping_service_additional_cost'],
                    'ShippingServiceCost'           => $order_data['shipping_service_cost'],
                    'ShippingServicePriority'       => $order_data['shipping_service_priority'],
                    'ShippingSurcharge'             => $order_data['shipping_surcharge']
                ]
            ],
            'Total'            => [
                '@attributes' => [
                    'currencyID' => $order_data['currency_id']
                ],
                '@value'      => $order_data['total']
            ],
            'TransactionArray' => [
                'Transaction' => $transaction_array
            ]
        ];

        return $this->requester->request($inputs, 'AddOrder');
    }

    /**
     * create the transaction array to be used in add order
     * @param $transactions
     *
     * @return array
     */
    public function createTransactionArray($transactions)
    {
        $transaction_array = [];

        foreach ($transactions as $transaction) {
            $_transaction = [
                'Item'          => [
                    'ItemID' => $transaction['item_id']
                ],
                'TransactionID' => 0 //$transaction['transaction_id']
            ];

            array_push($transaction_array, $_transaction);
        }

        return $transaction_array;
    }


    /**
     * update order with fulfillment data
     *
     * @param     $user_token
     * @param     $fulfillment_data
     * @param int $site_id
     *
     * @return mixed
     */
    public function fulfill($user_token, $fulfillment_data, $site_id = 1)
    {
        $inputs = [];
        $inputs['RequesterCredentials'] = [
            'eBayAuthToken' => $user_token
        ];
        $inputs['OrderID'] = [
            $fulfillment_data['order_id']
        ];
        $inputs['Paid'] = [
            $fulfillment_data['paid']
        ];
        $inputs['Shipped'] = [
            $fulfillment_data['shipped']
        ];
        $inputs['Shipment'] = [
            'ShipmentTrackingDetails' => [
                'ShipmentTrackingNumber' => [
                    $fulfillment_data['tracking_number']
                ],
                'ShipmentCarrieUsed'     => [
                    $fulfillment_data['carrier']
                ]
            ]
        ];


        return $this->requester->request($inputs, 'CompleteSale', $site_id);
    }
}