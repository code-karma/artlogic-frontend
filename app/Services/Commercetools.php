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

        $body = $this->postPayload();
        //return $body;
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
            //'custom' => [],
            'inventoryMode' => 'None',
            'taxRoundingMode' => 'HalfEven',
            'taxCalculationMode' => 'LineItemLevel',
            'origin' => 'Customer', // Const
            //'itemShippingAddresses' => [],
            //'store' => $this->getStoreRef()
        ];
    }

    private function getOrderNumber() {
        return 'de-php-sdk-02';
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
            'shippingRate' => $this->getShippingrate(),
            'taxRate' => $this->getShippingTaxRate(),
            'taxCategory' => $this->getTaxCategoryRef(),
            'shippingMethod' => $this->getShippingMethodRef(),
            //'deliveries' => [],
            //'discountedPrice' => [],
            'shippingMethodState' => 'MatchesCart',
        ];
    }

    private function getShippingrate() {
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
            //'prices' => [static::TYPE => PriceCollection::class],
            //'attributes' => [static::TYPE => AttributeCollection::class],
            //'images' => [static::TYPE => ImageCollection::class],
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

