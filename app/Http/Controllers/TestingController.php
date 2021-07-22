<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Services\Commercetools\Service;
use App\Services\Commercetools;

class TestingController extends Controller
{
    public function __construct()
    {
        $this->ct_client = new Commercetools();

    }

    /*public function __construct(DeliveryClient $client)
    {
        $this->delivery = new ContentfulDelivery($client);
    }*/

    public function importOrder($id = 1)
    {
        return $this->ct_client->importOrder($id);
    }

    public function getAsset()
    {
        //return $this->delivery->getAsset($id);
    }


    public function postOrderImport()
    {
        $json = self::buildJsonPayload($body);
        $http = new Service();
        $response = $http->post();
        return $response;
    }

}