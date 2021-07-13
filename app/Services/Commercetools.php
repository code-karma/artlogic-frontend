<?php

namespace App\Services;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Client;
use Commercetools\Core\Config;
use Commercetools\Core\Model\Common\Context;


class Commercetools //extends Api
{
    public function getProducts() {
        $config = [
            'project' => 'flink-staging',
            'client_id' => 'n8n6-hrjakVIT2ursBf5XUv-',
            'client_secret' => 'C3neLSCneOYot5K06c4BlUbLf2UanBg9',
            //'oauth_url' => 'https://auth.europe-west1.gcp.commercetools.com',
            //'api_url' => 'https://api.europe-west1.gcp.commercetools.com',
            //'scope' => 'manage_project:flink-staging'
        ];
        $context = Context::of()->setLanguages(['de'])->setLocale('DE-DE');
        $config = Config::fromArray($config)->setContext($context);
        //$search = RequestBuilder::of()->productProjections()->search()->addParam('text.de-DE', 'Himbeere');

        $search = RequestBuilder::of()->orders()->getByOrderNumber('de-ber-o08dv');

        $client = Client::ofConfig($config);
        $order = $client->execute($search)->toObject();

        //var_dump($products);exit();
//        $data = [];
//        foreach ($products as $product) {
//            $name = $product->toArray();
//            $data[] = $name;
//        }

        return response()->json($order);
    }

}

