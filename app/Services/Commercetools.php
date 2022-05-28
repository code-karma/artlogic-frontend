<?php

namespace App\Services;

use Commercetools\Api\Models\Order\OrderImportDraftBuilder;
use Commercetools\Api\Models\Order\OrderImportDraftModel;
use Commercetools\Api\Models\Order\LineItemImportDraftModel;
use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Import\Client\ImportRequestBuilder;
use Commercetools\Core\Client;
//use Commercetools\Core\Config;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Api\Client\ClientCredentialsConfig;
use Commercetools\Client\ClientCredentials;
use Commercetools\Client\ClientFactory;
use Commercetools\Api\Client\Config;
use Commercetools\Api\Client\ApiRequestBuilder;
use GuzzleHttp\ClientInterface;

use function PHPSTORM_META\type;


class Commercetools
{
    const TYPE = 'type';
    const OPTIONAL = 'optional';
    const INITIALIZED = 'initialized';
    const DECORATOR = 'decorator';
    const ELEMENT_TYPE = 'elementType';

    public function importOrder($id) {
        /** @var string $clientId */
        /** @var string $clientSecret */
        $clientId = 'n8n6-hrjakVIT2ursBf5XUv-';
        $clientSecret = 'C3neLSCneOYot5K06c4BlUbLf2UanBg9';
        $projectKey = 'flink-staging';
        $authConfig = new ClientCredentialsConfig(new ClientCredentials($clientId, $clientSecret));

        $client = ClientFactory::of()->createGuzzleClient(
            new Config(),
            $authConfig
        );






        $string = file_get_contents("/home/forge/distractionless.com/resources/views/warehouses_ids.json");
        $array = json_decode($string, true);

        $list = file_get_contents("/home/forge/distractionless.com/resources/views/last-php.json");
        $items = json_decode($list, true);

        $edges = $array['data']['warehouses']['edges'];

        $data = [];
        foreach ($edges as $edge) {
            $data[] = $edge['node'];
        }
        return $data;

        $res = [];
        foreach ($items as $item) {
            $hub_id = false;
            foreach ($data as $hub) {
                if ($hub['slug'] === $item['hub']) {
                    $hub_id = $hub['id'];
                }
            }
            $res[] = [
                'sku' => $item['sku'],
                'hub' => $item['hub'],
                'hub_id' => $hub_id ? $hub_id : null,
            ];
        }

        return $res;



        $body = $this->postPayload();
        return $body;











        $options = [
            'body' => json_encode($body)
        ];
        try {
            $response = $client->request('POST', '/'.$projectKey.'/orders/import', $options);
        }
        catch (\GuzzleHttp\Exception\ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
        catch(\GuzzleHttp\Exception\BadResponseException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
        catch(\Exception $e){
            return json_decode($e->getMessage(), true);
        }
        return json_decode($response->getBody(),true);
        /*
        $body = $this->buildPayload();
        //var_dump($body);exit;
        $builder =  new ApiRequestBuilder($client);
        $request = $builder
            ->withProjectKey($projectKey)
            ->orders()
            ->importOrder()
            ->post($body);

        $project = $request->execute();
        */

        //return $res;
    }

    private function buildPayload() { // this was an attempt to use the full SDK....
        $orderImport = new OrderImportDraftModel();
        $data = $this->postPayload();

        $orderImport->setOrderNumber($data['orderNumber']);
        $orderImport->setCustomerId($data['customerId']);
        $orderImport->setCustomerEmail($data['customerEmail']);
        //$orderImport->setLineItems($this->getLineItems());

        var_dump($orderImport);exit;
    }

    private function postPayload() {
        return [
            'orderNumber' => $this->getOrderNumber(),
            'customerId' => $this->getCustomerId(),
            'customerEmail' => $this->getCustomerEmail(),

            // Possible Logic: If product variant by SKU exists create lineItems
            // with product key/reference, otherwise create a customLineItem.
            'lineItems' => $this->getLineItems(),
            //'customLineItems' => [],


            'totalPrice' => $this->getTotalMoney(),
            'taxedPrice' => $this->getTaxedPrice(),
            'shippingAddress' => $this->getShippingAddress(),
            'billingAddress' => $this->getBillingAddress(),
            //'customerGroup' => [],
            'country' => 'DE',
            'orderState' => 'Complete', // Const
            'shipmentState' => 'Shipped', // Const
            'paymentState' => 'Paid', // Const
            'shippingInfo' => $this->getShippingInfo(),
            //'state' => [], // TBC?
            //'taxMode' => 'Platform', // TBC?
            'completedAt' => '2021-07-21T14:23:34.123Z',
            'custom' => $this->getCustomFields(),
            'inventoryMode' => 'None',
            'taxRoundingMode' => 'HalfEven',
            'taxCalculationMode' => 'LineItemLevel',
            'origin' => 'Customer', // Const
            //'itemShippingAddresses' => [],
            //'store' => $this->getStoreRef()
        ];
    }

    private function getCustomFields() {

        return [
            'typeId' => 'f9c58f19-bccc-449c-920c-fbaa42a179cb', // identifier to the custom fields
            'fields' => [
                'trackingId' => '42a31ec0-f2ad-49b0-8ac6-db933e9bf845',
                'deliveryPDT' => '2021-07-20T08:23:00.000Z',
                'deliveryCoordinates' => '47.505198, 11.278628',
                'isAuthoritative' => false,
                'stateChanges' => '[{\"timestamp\":\"2021-07-20T12:05:35Z\",\"from_state\":\"order-created\",\"to_state\":\"order-rider-claimed\"},{\"timestamp\":\"2021-07-20T12:05:35Z\",\"from_state\":\"order-rider-claimed\",\"to_state\":\"order-on-route\"},{\"timestamp\":\"2021-07-20T12:05:49Z\",\"from_state\":\"order-on-route\",\"to_state\":\"order-delivered\"}]',
                'pickerID' => 'thisispickerid',
                'trackingProvider' => 'onfleet',
                'customerNote' => 'This is customer note',
                'riderId' => '56f42907-f6aa-4892-8a65-6fcb9d92f1ac',
                'deliveryETA' => '2021-07-20T08:23:00.000Z'
            ],
        ];


    }

    private function getOrderNumber() {
        return 'de-php-sdk-03';
    }

    private function getCustomerId() {
        return '53fbb388-8eed-4788-b5f3-07bbcf21940f';
    }

    private function getCustomerEmail() {
        return 'yassinebeltar@gmail.com';
    }

    private function getLineItems() {

        $response[] = [
            //'productId' => '',
            'name' => [
                'de' => 'Kombuchery Raw Johannisbeere Bio-Kombucha 330ml (DE-DE)'
            ],
            'variant' => $this->getProductVariant(),
            'price' => $this->getPrice(),
            'quantity' => 2,
            'state' => $this->getLineState(),
            'supplyChannel' => $this->getLineChannelRef(),
            'distributionChannel' => $this->getLineChannelRef(),
            'taxRate' => [static::TYPE => TaxRate::class],
            //'custom' => [],
            'shippingDetails' => $this->getItemShippingDetails(),
        ];
        return $response;
    }

    private function getLineState() {
        $lineStates = [
            2
        ];
        foreach ($lineStates as $key => $quantity) {
            $array[] = [
                'quantity' => $quantity,
                'state' => $this->getLineStateRef()
            ];
        }
        return $array;
    }

    private function getLineStateRef() {
        return [
            'typeId' => 'state',
            'id' => 'a08a54ff-ee5e-4813-9602-9e47cb9f9dc0'
        ];
    }

    private function getLineChannelRef() {
        return [
            'typeId' => 'channel',
            'id' => '485b7609-1518-472c-926e-559946950a94'
        ];
    }

    private function getTaxCategoryRef() {
        return [
            'typeId' => 'tax-category',
            'id' => 'eb34adc9-b0c5-4cf2-8b10-85183843360d'
        ];
    }

    private function getShippingMethodRef() {
        return [
            'typeId' => 'shipping-method',
            'id' => 'e6a38649-63b8-4232-b12b-d4bbb44e7a5f'
        ];
    }

    private function getStoreRef() {
        return [
            'typeId' => 'store',
            'key' => 'erp_spitzbergen'
        ];
    }

    private function getTaxedPrice() {
        return [
            'totalNet' => $this->getTotalGrossMoney(),
            'totalGross' => $this->getTotalNetMoney(),
            'taxPortions' => $this->getTaxPortion(),
        ];
    }

    private function getShippingAddress() {
        return [
            'firstName' => 'Wojtek',
            'lastName' => 'Bronikowski',
            'company' => 'Flin',
            'streetName' => 'Lobeckstraße',
            'streetNumber' => '30-35',
            'additionalStreetInfo' => '',
            'postalCode' => '10969',
            'city' => 'Berlin',
            //'region' => '',
            //'state' => '',   // US & Canada
            'country' => 'DE',
            'phone' => '+48 7954984369'

        ];
    }

    private function getBillingAddress() {
        return [
            'firstName' => 'Wojtek',
            'lastName' => 'Bronikowski',
            'company' => 'Flin',
            'streetName' => 'Lobeckstraße',
            'streetNumber' => '30-35',
            'additionalStreetInfo' => '',
            'postalCode' => '10969',
            'city' => 'Berlin',
            //'region' => '',
            //'state' => '',   // US & Canada
            'country' => 'DE',
            'phone' => '+48 7954984369'

        ];
    }

    private function getShippingInfo() {
        return [
            'shippingMethodName' => 'Standard',
            'price' => $this->getShippingPriceMoney(),
            'shippingRate' => $this->getShippingRate(),
            'taxRate' => $this->getShippingTaxRate(),
            'taxCategory' => $this->getTaxCategoryRef(),
            'shippingMethod' => $this->getShippingMethodRef(),
            //'deliveries' => [],
            //'discountedPrice' => [],
            'shippingMethodState' => 'MatchesCart',
        ];
    }

    private function getShippingRate() {
        return [
            'price' => $this->getShippingPriceMoney(),
            //'tiers' => []
        ];
    }

    private function getShippingTaxRate() {
        return [
            'name' => '19% MwSt',
            'amount' => 0.19,
            'includedInPrice' => true,
            'country' => 'DE',
            //'state' => '', // US $ Canada
            //'subRates' => [],
        ];

    }

    private function getProductVariant() {
        return [
            //'id' => [static::TYPE => 'int'],
            'sku' => '11012387',
            'prices' => $this->getVariantPrice(),
            //'attributes' => $this->getVariantAttribute(),
            //'images' => $this->getVariantImages(),
        ];
    }

    private function getVariantPrice() {
        $array[] = [
            //'id' => '', // READ ONLY
            'value' => $this->getProductVariantValue(),
            'country' => 'DE',
            //'customerGroup' => [],
            //'channel' => $this->getLineChannelRef(),
            //'validFrom' => '',
            //'validUntil' => '',
            //'tiers' => '',
            //'discounted' => '',
            //'custom' => '',
        ];
        return $array;
    }

    private function getVariantAttribute() {
        return [];
    }

    private function getVariantImages() {
        return [
            '' => ''
        ];
    }



    private function getItemShippingDetails() {
        return [
            'addressKey' => '0',
            'quantity' => 2,
        ];
    }

    const CURRENCY_CODE = 'currencyCode';
    const CENT_AMOUNT = 'centAmount';
    const FRACTION_DIGITS = 'fractionDigits';
    const TYPE_CENT_PRECISION = 'centPrecision';
    const TYPE_HIGH_PRECISION = 'highPrecision';

    public function getTotalMoney()
    {
        return [
            static::CURRENCY_CODE => 'EUR',
            static::CENT_AMOUNT => 598,
        ];
    }

    public function getPriceMoney()
    {
        return [
            static::CURRENCY_CODE => 'EUR',
            static::CENT_AMOUNT => 299,
        ];
    }

    public function getTotalNetMoney()
    {
        return [
            static::CURRENCY_CODE => 'EUR',
            static::CENT_AMOUNT => 478,
        ];
    }

    public function getTotalGrossMoney()
    {
        return [
            static::CURRENCY_CODE => 'EUR',
            static::CENT_AMOUNT => 598,
        ];
    }

    public function getShippingPriceMoney()
    {
        return [
            static::CURRENCY_CODE => 'EUR',
            static::CENT_AMOUNT => 180,
        ];
    }

    public function getProductVariantValue()
    {
        return [
            static::CURRENCY_CODE => 'EUR',
            static::CENT_AMOUNT => 598,
        ];
    }

    public function getTaxPortion()
    {
        $array = [];
        $total = 598;
        $rates = [
            '7% MwSt'  => 0.07,
            '19% MwSt'  => 0.19,
        ];

        foreach ($rates as $name => $rate) {
            $array[] = [
                'name'=> $name,
                'rate' => $rate,
                'amount' => [
                    static::CURRENCY_CODE => 'EUR',
                    static::CENT_AMOUNT => round($total * $rate),
                ]
            ];
        }

        return $array;
    }

    public function getPrice()
    {
        return [
            'value' => $this->getPriceMoney()
        ];
    }

}

