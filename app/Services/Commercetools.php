<?php

namespace App\Services;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Client;
use Commercetools\Core\Config;
use Commercetools\Core\Model\Common\Context;


class Commercetools //extends Api
{

    const TYPE = 'type';
    const OPTIONAL = 'optional';
    const INITIALIZED = 'initialized';
    const DECORATOR = 'decorator';
    const ELEMENT_TYPE = 'elementType';

    public function importOrder($id) {
        $config = [
            'project' => 'flink-staging',
            'client_id' => 'n8n6-hrjakVIT2ursBf5XUv-',
            'client_secret' => 'C3neLSCneOYot5K06c4BlUbLf2UanBg9',
            //'oauth_url' => 'https://auth.europe-west1.gcp.commercetools.com',
            //'api_url' => 'https://api.europe-west1.gcp.commercetools.com',
            //'scope' => 'manage_project:flink-staging'
        ];

        $data = $this->postPayload();

        $context = Context::of()->setLanguages(['de'])->setLocale('DE-DE');
        $config = Config::fromArray($config)->setContext($context);
        //$search = RequestBuilder::of()->productProjections()->search()->addParam('text.de-DE', 'Himbeere');

        //$build = RequestBuilder::of()->orders()->import($data);

        //$client = Client::ofConfig($config);
        //$order = $client->execute($build)->toObject();

        //var_dump($products);exit();
//        $data = [];
//        foreach ($products as $product) {
//            $name = $product->toArray();
//            $data[] = $name;
//        }

        return response()->json($data);
    }

    private function postPayload() {
        $data = [
            'orderNumber' => $this->getOrderNumber(),
            'customerId' => $this->getCustomerId(),
            'customerEmail' => $this->getCustomerEmail(),
            'lineItems' => $this->getLineItems(),
            'customLineItems' => [],
            'totalPrice' => $this->getTotalMoney(),
            //'taxedPrice' => '',
            'shippingAddress' => [],
            'billingAddress' => [],
            'customerGroup' => [],
            'country' => 'DE',
            'orderState' => 'Complete', // Const
            'shipmentState' => 'Shipped', // Const
            'paymentState' => 'Paid', // Const
            'shippingInfo' => [],
            'completedAt' => '2021-07-21T14:23:34.123Z',
            'custom' => [],
            'inventoryMode' => [],
            //'taxRoundingMode' => '',
            'origin' => 'Customer', // Const
            //'taxCalculationMode' => '',
            'itemShippingAddresses' => [],
            //'store' => ''
        ];
        return $data;
    }

    private function getOrderNumber() {
        return 'de-php-sdk-01';
    }

    private function getCustomerId() {
        return '53fbb388-8eed-4788-b5f3-07bbcf21940f';
    }

    private function getCustomerEmail() {
        return 'yassinebeltar@gmail.com';
    }

    private function getLineItems() {
        return [
            //'productId' => '',
            'name' => 'Kombuchery Raw Johannisbeere Bio-Kombucha 330ml (DE-DE)',
            'variant' => $this->getProductVariant(),
            //'price' => [static::TYPE => Price::class],
            'quantity' => 2,
            //'state' => [static::TYPE => ItemStateCollection::class],
            //'supplyChannel' => [static::TYPE => ChannelReference::class],
            //'distributionChannel' => [static::TYPE => ChannelReference::class],
            //'taxRate' => [static::TYPE => TaxRate::class],
            //'custom' => [static::TYPE => CustomFieldObjectDraft::class],
            'shippingDetails' => $this->getItemShippingDetails(),
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
            static::CENT_AMOUNT => 5.98,
        ];
    }

}

